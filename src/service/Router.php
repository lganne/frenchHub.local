<?php

namespace service;

/**
 * Description of Router
 *
 * 
 */
class Router 
{

    protected $routes = [];

    /**
     * 
     * @param array $routes
     * @throws \RuntimeException
     */
    public function addRoute(array $routes)
    {
        foreach ($routes as $route => $info) {

            if (isset($this->routes[$route])) {
                throw new \RuntimeException(\sprintf('Cannot override route "%s".', $route));
            }

            $this->routes[$route] = $info;
        }
    }

    /**
     * 
     * @param type $url
     */
    public function getRoute($url)
    {
        
        $routing = [];
        foreach ($this->routes as $route) {
            if (preg_match('/^' . $route['pattern'] . '$/', $url, $matches)) {
                
                $routes = explode(':', $route['connect']);
                $params = (isset($route['params']))? explode(':', $route['params']) : [];
                
                list($controller, $action) = $routes;

                $routing = [
                    'controller' => $controller,
                    'action' => $action,
                    'params' => $this->getParams($params, $matches)
                ];
                
                return $routing;
            }
        }
        
        throw new \RuntimeException("bad route exception");
    }

    /**
     * 
     * @param array $params
     * @param array $matches
     * @return array
     */
    public function getParams(array $params, array $matches)
    {

        if (empty($params)) {
            return;
        }

        $values=[];
        
        foreach ($params as $p) {
            $values[$p] = $matches[$p];
        }
        return $values;
    }
    
    
}
