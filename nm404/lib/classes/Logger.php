<?php

defined( 'ABSPATH' ) or die();

class NM404_Logger  {

    public function log_error($message) {
        return $this->append(
            json_encode(array('time' => time(), 'message' => $message)),
            $this->get_log_error_file_path()
        );
    }

    public function get_redirect_logs($count=1000){
        $file =get_option(NM404_PREFIX.'log-redirect');
        if(!empty($file) && is_readable($file)) return explode("\n", $this->tail_read($file, $count));
        return false;
    }

    public function get_error_logs($count=1000){
        $file =get_option(NM404_PREFIX.'log-error');
        if(!empty($file) && is_readable($file)) return explode("\n", $this->tail_read($file, $count));
        return false;
    }

    public function flush_redirect_logs() {
        $file =get_option(NM404_PREFIX.'log-redirect');
        delete_option(NM404_PREFIX.'log-redirect');
        if(!empty($file) && is_writable($file)) {
            @unlink($file);
        }
    }

    public function flush_error_logs() {
        $file =get_option(NM404_PREFIX.'log-error');
        delete_option(NM404_PREFIX.'log-error');
        if(!empty($file) && is_writable($file)) {
            @unlink($file);
        }
    }

    public function log_redirect($url, $redirect) {
        return $this->append(
            json_encode(array('time' => time(), 'url' => $url, 'target' => $redirect)),
            $this->get_log_redirect_file_path()
        );
    }

    public function cleanup() {

        $f = $this->get_log_error_file_path();
        $f2 = $this->get_log_redirect_file_path();

        if(filesize($f) > 1000000) {
            $d = $this->tail_read($f, 30);
            if(!empty($f) && is_writable($f)) {
                file_put_contents($f, $d);
            }
        }

        if(filesize($f2) > 1000000) {
            $d = $this->tail_read($f2, 1000);
            if(!empty($f2) && is_writable($f2)) {
                file_put_contents($f2, $d);
            }
        }
    }


    private function tail_read($file, $lines = 1, $adaptive = true) {
        $f = @fopen($file, "rb");
        if ($f === false) return false;
        if (!$adaptive) $buffer = 4096;
        else $buffer = ($lines < 2 ? 64 : ($lines < 10 ? 512 : 4096));
        fseek($f, -1, SEEK_END);
        if (fread($f, 1) != "\n") $lines -= 1;
        $output = '';
        $chunk = '';
        while (ftell($f) > 0 && $lines >= 0) {
            $seek = min(ftell($f), $buffer);
            fseek($f, -$seek, SEEK_CUR);
            $output = ($chunk = fread($f, $seek)) . $output;
            fseek($f, -mb_strlen($chunk, '8bit'), SEEK_CUR);
            $lines -= substr_count($chunk, "\n");
        }
        while ($lines++ < 0) {
            $output = substr($output, strpos($output, "\n") + 1);
        }
        fclose($f);
        return trim($output);
    }


    private function append($text, $file) {
        if(!$file) return false;

        if(!file_exists($file)) {
            @touch($file);
        }

        if(file_exists($file) && is_writable($file)) {
            if(!empty($text)) {
                file_put_contents($file, $text."\n", FILE_APPEND);
            }
            return true;
        }

        return false;
    }


    public function get_log_error_file_path() {
        $file =get_option(NM404_PREFIX.'log-error');
        if(!$file) {
            $file = WP_CONTENT_DIR. '/'. substr( md5(time()), 0, 15).'-nm404-log-error.log';
            update_option(NM404_PREFIX.'log-error', $file);
        }
        return $file;
    }

    public function get_log_redirect_file_path() {
        $file =get_option(NM404_PREFIX.'log-redirect');
        if(!$file) {
            $file = WP_CONTENT_DIR. '/'. substr( md5(time()), 0, 15).'-nm404-log-redirect.log';
            update_option(NM404_PREFIX.'log-redirect', $file);
        }
        return $file;
    }

}