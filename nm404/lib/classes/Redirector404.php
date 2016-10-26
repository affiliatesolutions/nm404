<?php

defined( 'ABSPATH' ) or die();

class Redirector404{

    private $sitemap="";
    private $_sitemap ="/sitemap.xml";
    private $parse_limit=1000;

    private $prot="http://";
    private $distance=-1;
    private $redirect=null;
    private $settings=null;
    private $siteQueue=null;
    private $url;
    private $logger;
    private $start_time;

    function __construct() {
        $this->start_time = time();
        add_action('template_redirect', array ($this, 'check'));
        $this->settings=maybe_unserialize(get_option('NM404settings'));
        $this->logger = new NM404_Logger();

        if(!empty($this->settings["sitemap_url"])){
            $this->_sitemap=$this->settings["sitemap_url"];
        }
        if(!empty($this->settings["limit_parsed_entries"])
            && $this->settings["limit_parsed_entries"]!=0){
            $this->parse_limit=$this->settings["limit_parsed_entries"];
        }
        $this->siteQueue=new SiteQueue();
    }

    function check(){
        if(is_404()&&@$_GET["_nm404nocheck_"]!=="true"){
            $this->url=$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
            $this->setProt();
            $this->redirect=$this->prot.$_SERVER['SERVER_NAME'];
            $url=parse_url($this->_sitemap);
            if($url["host"]=="") {
                $this->sitemap = $this->prot . $_SERVER['SERVER_NAME'] . $this->_sitemap;
            } else{
                $this->sitemap= $this->_sitemap;
            }

            if(rand(0, 100) == 100) $this->logger->cleanup();

            $this->parseSitemap();
            $this->redirect();
        }
    }


    private function setProt(){
        if (strpos($_SERVER["SCRIPT_URI"],"https")!==false){
            $this->prot ="https://";
        } else {
            $this->prot ="http://";
        }
    }

    private function parseSitemap(){
        $timeout = 5; if(isset($this->settings['timeout'])) { $timeout = (int) $this->settings['timeout']; }

        $options = array(
            'http' => array(
                'method' => 'GET',
                'timeout' => $timeout,
                'user_agent' => 'WordPress NM404 Sitemap parser',
            )
        );
        $context = stream_context_create($options);
        libxml_set_streams_context($context);

        $dom = new DOMDocument;
        if(@$dom->load($this->buildUrl($this->sitemap)) === false) {
            $this->logger->log_error(sprintf(__('Loading of %s took longer than %d seconds or resulted in an 404 http error, displaying default 404 error page.', NM404_TEXT_DOMAIN), $this->sitemap, $timeout));
            return;
        }

        $sitemaps=$dom->getElementsByTagName('sitemap')->length;
        if($sitemaps >0){
            $submaps=$this->getSubmaps($dom);
            foreach($submaps as $submap){
                if( (time() - $this->start_time) >= $timeout) {
                    $current_execution_time = time() - $this->start_time;
                    $this->logger->log_error(sprintf(__('Loading of the sub sitemaps (execution time in seconds: %d, timeout in seconds: %d) exhausted the timeout, displaying default 404 error page.', NM404_TEXT_DOMAIN), $current_execution_time, $timeout));
                    $this->siteQueue=null;
                    return;
                }
                $this->getShortest($submap);
            }
        }
        else{
            $this->getShortest($this->sitemap);
        }
    }

    private function getSubmaps($dom){
        $asitemaps=array();
        foreach($dom->getElementsByTagName('loc') as $sitemap){
            $asitemaps[]=(string)$sitemap->nodeValue;
        }
        return $asitemaps;
    }

    private function getShortest($sitemap){
        $dom = new DOMDocument;
        if(@$dom->load((string)$sitemap) === false) {
            $this->logger->log_error(sprintf(__('Loading of %s took longer than %d seconds or resulted in an http 404 error, displaying default 404 error page.', NM404_TEXT_DOMAIN), $sitemap, (int)$this->settings['timeout']));
            return;
        }
        $i=0;
        foreach($dom->getElementsByTagName('url') as $child){
            foreach($child->getElementsByTagName('loc') as $url){
                if($this->parse_limit>0 && ++$i>$this->parse_limit){
                    return;
                }
                $loc=(string)$url->nodeValue;
                $lev = levenshtein($this->url, $loc);
                $this->siteQueue->insert(array("dist"=>$lev,"url"=>$loc));
            }
        }
    }

    public function redirect(){
        $heap=new SplMinHeap();
        foreach($this->siteQueue as $value){
            $heap->insert($value);
        }

        foreach($heap as $value){
            $response = wp_remote_head( $this->buildUrl($value["url"]) );
            if( is_array($response) ) {
                $header = $response['response'];
                if($header["code"]==200){
                    $this->logger->log_redirect($this->url, $value['url']);
                    wp_redirect($value["url"],301);
                    exit;
                }
            }
        }
    }

    public function buildUrl($url){
        $url = parse_url((string) $url);
        parse_str(@$url["query"], $query);
        $query['_nm404nocheck_'] = "true";
        return $url["scheme"].'://'.$url['host'].$url['path'].'?'.urldecode(http_build_query($query));
    }

}