<?php
namespace Framework;

use App\Controllers\ErrorController;


class Router{
    protected $routes=[];

    /**
     * 
     * Add a new route
     * 
     * @param string $method
     * @param string $uri
     * @param string $action
     * @return void
     */

    public function registerRoutes($method,$uri,$action){
       list($controller,$controllerMethod)=explode("@",$action);

        $this->routes[]=[
            'method'=>$method,
            'uri'=>$uri,
            'controller'=>$controller,
            'controllerMethod'=>$controllerMethod
        ];
    }


    /**
     * 
     * Add a GET route
     * 
     * @param string $uri
     * @param string $controller
     * @return void
     * 
     */

     public function get($uri,$controller){
       $this->registerRoutes("GET",$uri,$controller);
     }

    /**
     * 
     * Add a POST route
     * 
     * @param string $uri
     * @param string $controller
     * @return void
     * 
     */

     public function post($uri,$controller){
        $this->registerRoutes("POST",$uri,$controller);
     }

    /**
     * 
     * Add a PUT route
     * 
     * @param string $uri
     * @param string $controller
     * @return void
     * 
     */

     public function put($uri,$controller){
        $this->registerRoutes("PUT",$uri,$controller);
     }

    /**
     * 
     * Add a DELETE route
     * 
     * @param string $uri
     * @param string $controller
     * @return void
     * 
     */

     public function delete($uri,$controller){
        $this->registerRoutes('DELETE',$uri,$controller);
     }

        /**
     * 
     * Route the request
     * 
     * @param string $uri
     * @param string $controller
     * @return void
     * 
     */

     public function route($uri){

      $requestMethod=$_SERVER["REQUEST_METHOD"];

    
 if($requestMethod==='POST'&&isset($_POST['method'])){
   $requestMethod=strtoupper($_POST['_method']);
 }

        foreach ($this->routes as $route){
         $uriSegments=explode("/",trim($uri,"/"));
         $routeSegments=explode('/',trim($route['uri'],'/'));
   
         $match=true;

         if(count($uriSegments)===count($routeSegments)&&strtoupper($route['method']===$requestMethod))
         {

            $params=[];

            $match=true;

            for($i=0; $i <count($uriSegments); $i++)
            {
               if($routeSegments[$i]!==$uriSegments[$i]&&!preg_match('/\{(.+?)\}/',$routeSegments[$i])){
                  $match=false;
                  break;
               }

               if(preg_match('/\{(.+?)\}/',$routeSegments[$i],$matches))
               {
               $params[$matches[1]]=$uriSegments[$i];
               }
            }

            if($match){

               $controller='App\\Controllers\\'.$route['controller'];
               $controllerMethod=$route['controllerMethod'];

               $controllerInstance=new $controller();
               $controllerInstance->$controllerMethod($params);
               return ;

            }
         }
           
        }
ErrorController::notFound();
      
     }
}