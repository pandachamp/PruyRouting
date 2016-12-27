<?php

namespace PruyRouting;

class Route {


    private static function getRoute(){
        $base = str_replace("index.php","",$_SERVER['SCRIPT_NAME']);
        $requestURI = str_replace($base,"",$_SERVER['REQUEST_URI']);

        $route = explode("/",$requestURI);
        $method = $_SERVER['REQUEST_METHOD'];

        $data['route'] = $route;
        $data['method'] = $method;
        return $data;
    }

    private static function convertMethod($method){
        $converted = 0;
        if($method == "get"){
            $converted = "GET";
        }
        if($method == "post"){
            $converted = "POST";
        }

        return $converted;
    }

    public static function map($uri,$method,$action){
        $requestData = self::getRoute();
        $route = $requestData['route'];
        $reMethod = $requestData['method'];
        $splUri = explode("/",$uri);
        $request = array();
        $httprequest = $_REQUEST;
        $index = 0;
        if(strpos($route[0], '?') !== false){
            $route[0] = explode("?",$route[0])[0];
        }

        if($route[0]===$splUri[1] && $reMethod === self::convertMethod($method) && sizeof($splUri)-1 == sizeof($route)){
            foreach ($splUri as $inuri){
                if($inuri == ""){

                }
                else if($inuri[0] == '{'){

                    $str = $inuri;
                    $str = str_replace("{","",$str);
                    $str = str_replace("}","",$str);

                    if(strpos($route[$index-1], '?') !== false){
                        $route[$index-1] = explode("?",$route[$index-1])[0];
                    }

                    $request[$str] = $route[$index-1];
                }
                $index++;
            }

            foreach ($httprequest as $key => $value){
                $request[$key] = $value;
            }
            $action($request);
        }
    }


}