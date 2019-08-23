<?php
    class ReplaceToken {
        
        public function replacePlaceholderCode() {
            // load the instance
            $this->CI =& get_instance();
            //$withgetparams = explode('?',$_SERVER['REQUEST_URI']);
            $string = explode('/', $_SERVER['REQUEST_URI']);
            if (mb_ereg_match('/[\'^£$%*()}{@#~><>,|+]/', implode('',$string))) {
                include(BASEPATH.'../application/views/error.php');
            }
        }
    }