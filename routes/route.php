<?php
namespace Routes;

class Route
{
    public static $routes;
    
    public static function get($url, $callback)
    {
        self::$routes[$url]=['url'=>$url,'callback'=>$callback,'request_method'=>'GET'];
    }

    public static function post($url, $callback)
    {
        self::$routes[$url]=['url'=>$url,'callback'=>$callback,'request_method'=>'POST'];
    }

    protected static function callback($url,$callback){
        $request_uri = self::parse_url();
        $parameters=self::parameters($url,$request_uri);
            
        if (is_callable($callback)) {
            call_user_func_array($callback, $parameters);
        }
        $callback_array = explode('@', $callback);  
        $class_name = $callback_array[0];
        $method_name = end($callback_array);
        
        call_user_func_array([new $class_name, $method_name], $parameters);
    }

    public static function parse_url()
    {
        $dirname = dirname($_SERVER['SCRIPT_NAME']);
        $dirname = $dirname != '/' ? $dirname : null;
        
        $basename = basename($_SERVER['SCRIPT_NAME']);
        
        $request_uri = str_replace([$dirname, $basename], null, $_SERVER['REQUEST_URI']);
        if($request_uri != '/'){
            $request_uri = ltrim($request_uri, '/');
        }
        
        return $request_uri;
    }


    protected static function parameters($url,$request_uri){
        $parameter_keys  = preg_grep('/^{/i', explode('/', $url));
        $parameters=[];
        if(count($parameter_keys)  > 0) {
            $array=explode('/',$request_uri);
            foreach(array_keys($parameter_keys) as $index){
                array_push($parameters,(is_numeric($array[$index])?intval($array[$index]):$array[$index]));
            }
        }
        return $parameters;
    }

    public static function run(){
        $route_status=false;
        $request_uri = self::parse_url();
       
        if(array_key_exists($request_uri, self::$routes)){
            $route_status=true;
            $req=self::$routes[$request_uri];
        }else{
            $request_uri_keys=explode('/',$request_uri);
            foreach(array_keys(self::$routes) as $key){
                
                $keys=explode('/',$key);
                if(count($keys) == count($request_uri_keys)){
                    $total_count=0;
                    foreach($keys as $index=>$value){
                        if(($request_uri_keys[$index]==$value)||preg_match('/^{/i', $value)){
                            $total_count+=1;
                        }
                    }
                    if(count($request_uri_keys)==$total_count){
                        $route_status=true;
                        $req=self::$routes[$key];
                        break;
                    }
                }
            }
        }

        if ($route_status) {
            if ($_SERVER['REQUEST_METHOD'] != $req['request_method']) {
                echo "The ".$_SERVER['REQUEST_METHOD']." method is not allowed.";
                die();
            }
            self::callback($req['url'],$req['callback']);
        }else {
        echo "The route is not defined.";
        die();
        }
    }

}