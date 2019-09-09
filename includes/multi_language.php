<?php

class multilanguage {
    function get_language() {
        if (isset($_SESSION['engine-language']))
            return $_SESSION['engine-language'];
        else
            return "en";
    }
    
    function set_language($lang) {
        $_SESSION['engine-language'] = $lang;
    }
    
    function add_language($module) {
        $dir = ROOT_PATH . 'langController';
        return $this->add_lang_code($dir . "/" . $module . "/" . $module . '_' . $this->get_language() . ".json");
    }
    
    function add_lang_code($file) {
        if(!empty($ui_string)) {
            $ui_string = array();
        }
        if (file_exists($file)) {
            $tmp = json_decode(file_get_contents($file));
            if ($tmp != "") {
                foreach ($tmp as $key => $val) {
                    $ui_string[$key] = $val;
                }
            }
        }
        return $ui_string;
    }
}
?>