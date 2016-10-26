<?php

defined( 'ABSPATH' ) or die();

class NM404_Admin {
    public static function init(){
        add_action( 'admin_menu' , array('NM404_Admin', 'registerAdminMenuEntrys'));
        add_action( 'admin_enqueue_scripts', array('NM404_Admin', 'wp_action_enqueue_scripts'), 2000 );
        add_action( 'admin_notices', array('NM404_Admin', 'admin_notices'));
    }

    public static function admin_notices() {
        $NM404_Logger = new NM404_Logger();
        $f = $NM404_Logger->get_log_redirect_file_path();
        if(!file_exists($f)) {
            @touch($f);
        }
        if(!file_exists($f) || !is_writable($f)) {
            $class = 'notice notice-error';
            $message = sprintf(__( 'nm404: An error has occurred, could not write to log file "%s".', NM404_TEXT_DOMAIN ), $f);
            printf( '<div class="%1$s"><p>%2$s</p></div>', $class, $message );
        }

        $f = $NM404_Logger->get_log_error_file_path();
        if(!file_exists($f)) {
            @touch($f);
        }
        if(!file_exists($f) || !is_writable($f)) {
            $class = 'notice notice-error';
            $message = sprintf(__( 'nm404: An error has occurred, could not write to log file "%s".', NM404_TEXT_DOMAIN ), $f);
            printf( '<div class="%1$s"><p>%2$s</p></div>', $class, $message );
        }
    }

    public static function registerAdminMenuEntrys(){

        add_menu_page(
            __('nm404', NM404_TEXT_DOMAIN),
            __('nm404', NM404_TEXT_DOMAIN),
            'manage_options',
            NM404_PREFIX.'menu',
            array('NM404_Admin', 'page_settings'),
            NM404_URL.'/static/img/nm404-logo.png',
            '81.2388'
        );

        add_submenu_page(
            NM404_PREFIX.'menu',
            __('General', NM404_TEXT_DOMAIN),
            __('General', NM404_TEXT_DOMAIN),
            'manage_options',
            NM404_PREFIX.'menu',
            array('NM404_Admin', 'page_settings')
        );


        add_submenu_page(
            NM404_PREFIX.'menu',
            __('Statistics', NM404_TEXT_DOMAIN),
            __('Statistics', NM404_TEXT_DOMAIN),
            'manage_options',
            NM404_PREFIX.'statistics',
            array('NM404_Admin', 'page_statistics')
        );

        add_submenu_page(
            NM404_PREFIX.'menu',
            __('Error Logs', NM404_TEXT_DOMAIN),
            __('Error Logs', NM404_TEXT_DOMAIN),
            'manage_options',
            NM404_PREFIX.'errors',
            array('NM404_Admin', 'page_errors')
        );

    }

    public static function page_statistics() {
        $logger = new NM404_Logger();

        if(isset($_POST['flush_logs']) && !empty($_POST['flush_logs'])) {
            $logger->flush_redirect_logs();
        }

        $a_logs = $logger->get_redirect_logs(1000);
        krsort($a_logs);

        $logs = array();
        foreach($a_logs as $log_json) {
            $log = json_decode($log_json, true);
            if(!empty($log['url'])) {
                $logs[$log['url']]++;
            }
        }

        arsort($logs);

        require_once(NM404_DIR.'/pages/statistics.php');
    }


    public static function page_errors() {
        $logger = new NM404_Logger();

        if(isset($_POST['flush_logs']) && !empty($_POST['flush_logs'])) {
            $logger->flush_error_logs();
        }

        $a_logs = $logger->get_error_logs(30);
        krsort($a_logs);
        require_once(NM404_DIR.'/pages/errors.php');

    }

    public static function page_settings(){
        $settings = maybe_unserialize(get_option('NM404settings'));
        if(@$settings["limit_parsed_entries"]==0){
            $settings["limit_parsed_entries"]=1000;
        }
        if(empty($settings["sitemap_url"])){
            $settings["sitemap_url"]="/sitemap.xml";
        }
        if(empty($settings["timeout"]) || (int)$settings['timeout'] <= 0){
            $settings["timeout"]=3;
        }

        if(isset($_POST['timeout'])) {
            $settings['timeout'] = (int) $_POST['timeout'];
            if(empty($settings["timeout"]) || (int)$settings['timeout'] <= 0){
                $settings["timeout"]=3;
            }
        }

        if(!empty($_POST["sitemap_url"])){
            $url=parse_url($_POST["sitemap_url"]);
            $options = array(
                'http' => array(
                    'method' => 'GET',
                    'timeout' => (int) $settings['timeout'],
                    'user_agent' => 'WordPress NM404 Sitemap parser',
                )
            );
            $dom = new DOMDocument;
            $context = stream_context_create($options);
            libxml_set_streams_context($context);

            $error = false;

            $NM404_Redirector = new Redirector404();

            if($url["host"]=="") {
                if(@$dom->load($NM404_Redirector->buildUrl("http://" . $_SERVER['SERVER_NAME'] . $_POST["sitemap_url"])) === false) {
                    $url = htmlentities("http://" . $_SERVER['SERVER_NAME'] . $_POST["sitemap_url"]);
                    $error = sprintf(__('Could not access sitemap %s ', NM404_TEXT_DOMAIN), $url);
                }
            } else {
                if (@$dom->load($NM404_Redirector->buildUrl($_POST["sitemap_url"])) === false){
                    $error = sprintf(__('Could not access sitemap %s ', NM404_TEXT_DOMAIN), $_POST["sitemap_url"]);
                }
            }
            $settings["sitemap_url"]=htmlentities($_POST["sitemap_url"]);
            $settings["limit_parsed_entries"]=(int)$_POST["limit_parsed_entries"];
            if(@$settings["limit_parsed_entries"]==0){
                $settings["limit_parsed_entries"]=1000;
            }

            if(!$error) update_option('NM404settings', serialize($settings));
        }

        require_once(NM404_DIR.'/pages/settings.php');
    }


    public static function wp_action_enqueue_scripts() {
        wp_enqueue_script(
            NM404_PREFIX.'bootstrap_js',
            NM404_URL.'static/js/bootstrap.min.js',
            array( 'jquery' )
        );


        wp_register_style( NM404_PREFIX.'bs', NM404_URL.'static/css/nm404-bs.css', false, '1.0.0' );
        wp_enqueue_style( NM404_PREFIX.'bs' );

        wp_register_style( NM404_PREFIX.'style', NM404_URL.'static/css/nm404.css', false, '1.0.0' );
        wp_enqueue_style( NM404_PREFIX.'style' );
    }
}