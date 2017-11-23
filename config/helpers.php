<?php 

class Helpers {

    public static function get_url_parameter($parameter_name){
        return $_SESSION['uri']['parameters'][$parameter_name];
    }

    public static function redirect($controller, $action, $parameters = []){
        $parameters_url = "";
        if(count($parameters) > 0) {
            foreach($parameters as $parameter_key => $parameter_value){
                $parameters_url .= $parameter_key . "/" . $parameter_value . "/";
            }
        }

        header("Location: " . $_SESSION['uri']['host'] . "/" . $controller . "/" . $action . "/" . $parameters_url);
        exit();
    }

    public static function flash_data($position, $value = "", $erase = false){

        if(empty($value)){

            $flash_data = $_SESSION['flash'][$position];

            if($erase) {
                unset($_SESSION['flash'][$position]);
            }

            return $flash_data;
        }
        
        if(!empty($_SESSION['flash'][$position])){

            if(count($_SESSION['flash'][$position]) == 1){
                $_SESSION['flash'][$position] = [$_SESSION['flash'][$position], $value];
            } else {
                $_SESSION['flash'][$position][] = $value;
            }

            return true;
        } elseif($_SESSION['flash'][$position] = $value){
            return true;
        }
            
        return false;
    }
    

    public static function validate_string($string){
        return  addslashes(strip_tags($string));
    }
    

    public static function validate_integer($integer){
        return  ((int) $integer);
    }
    

    public static function number_format($number, $invert = false){
        if(!$invert){
            return  number_format($number, 2, ",", ".");
        } else {
            return  number_format($number, 2, ".", ",");
        }
    }
    

    public static function die_dump($subject){
        var_dump($subject);
        die;
    }

}