<?php
namespace Core;

class Router
{
    protected $routes = []; //All routes are stored from routes.php
    
    public function add($uri, $controller, $method)
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method,
        ];
        return $this;
    }
    public function get($uri, $controller)
    {
        return $this->add($uri, $controller, 'GET');
    }
    public function post($uri, $controller)
    {
        return $this->add($uri, $controller, 'POST');
    }
    public function delete($uri, $controller)
    {
        return $this->add($uri, $controller, 'DELETE');
    }
    public function put($uri, $controller)
    {
        return $this->add($uri, $controller, 'PUT');
    }
    public function patch($uri, $controller)
    {
        return $this->add($uri, $controller, 'PATCH');
    }

    public function route($uri, $method)
    {
        
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
                return require base_path('controllers/'.$route['controller']);
            }
        }
        $this->abort();
    }
    public function abort($code = 404)
    {
        http_response_code($code);
        require base_path("views/{$code}.php");
        die();
    }
}
// $routes=require base_path('routes.php');
// $uri = (parse_url($_SERVER['REQUEST_URI']))['path'];
// // if($uri== '/'){
// //     require('controllers/index.php');
// // }
// // else if($uri== '/about'){
// //     require('controllers/about.php');
// // }
// // else if($uri== '/contact'){
// //     require('controllers/contact.php');
// // }

// function routeToController($uri, $routes)
// {
//     if (array_key_exists($uri, $routes)) {
//         require base_path($routes[$uri]);
//     } else {
//         abort();
//     }
// }

// function abort($code = 404)
// {
//     http_response_code($code);
//     require base_path("views/{$code}.php");
//     die();
// }

// routeToController($uri, $routes);

?>