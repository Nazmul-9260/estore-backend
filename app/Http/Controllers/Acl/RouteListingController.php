<?php

namespace App\Http\Controllers\Acl;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use ReflectionClass;

class RouteListingController extends Controller
{
    /**
     * Show listing of controller classes.
     * 
     */


    function getAllControllersWithMethods()
    {
        $controllers = [];

        // Get all routes in the application
        $routes = Route::getRoutes();

        foreach ($routes as $route) {
            // Check if the action is a controller (formatted as Controller@method)
            $action = $route->getActionName();

            if (strpos($action, '@') !== false) {
                // Extract controller and method
                [$controller, $method] = explode('@', $action);

                if (!isset($controllers[$controller])) {
                    // Use ReflectionClass to get methods of the controller
                    try {
                        $reflection = new ReflectionClass($controller);
                        $methods = array_filter($reflection->getMethods(), function ($method) use ($reflection) {
                            // Filter out inherited methods from parent classes
                            return $method->class === $reflection->getName();
                        });

                        $controllers[$controller] = array_map(function ($method) {
                            return $method->name;
                        }, $methods);
                    } catch (\ReflectionException $e) {
                        // Handle case where the controller doesn't exist or is not accessible
                        continue;
                    }
                }
            }
        }

        return $controllers;
    }

    function getAllControllersWithMethodsGrouped()
    {
        $controllers = [];

        $methods = [];

        $actionst = [];

        $controllerKeys = [];

        $controllersWithMethods = [];

        // Get all routes in the application
        $routes = Route::getRoutes();

        //return collect($routes);

        foreach ($routes as $route) {
            // Check if the action is a controller (formatted as Controller@method)
            $action = $route->getActionName();

            // $actionsT[] = $action;

            if (strpos($action, '@') !== false) {
                // Extract controller and method
                [$controller, $method] = explode('@', $action);

                if (!isset($controllers[$controller])) {
                    // Use ReflectionClass to get methods of the controller
                    try {
                        $reflection = new ReflectionClass($controller);
                        $methods = array_filter($reflection->getMethods(), function ($method) use ($reflection) {
                            // Filter out inherited methods from parent classes
                            return $method->class === $reflection->getName();
                        });

                        $controllers[$controller] = array_map(function ($method) {
                            return $method->name;
                        }, $methods);
                    } catch (\ReflectionException $e) {
                        // Handle case where the controller doesn't exist or is not accessible
                        continue;
                    }
                }
            }
        }

        // return $actionsT;

        // return $controllers;

        // Create DS

        $controllersToSpare = [
            'CsrfCookie',
            'Login',
            'Register',
            'ForgotPassword',
            'ResetPassword',
            'ConfirmPassword',
            'RouteListing'
        ];

        $controllersArr =  collect(array_keys($controllers))->map(function ($controller) use ($controllersToSpare) {
            $controllerStringArr = explode('\\', $controller);
            $controllerName =  end($controllerStringArr);
            $modelName = str_replace('Controller', '', $controllerName);
            if (!in_array($modelName, $controllersToSpare)) {
                return $modelName;
            }
            // $controllersWithMethods[$modelName] = $controllers[$controller];
        });

        $controllersArr = array_unique(array_filter($controllersArr->toArray()));

        foreach (collect($controllers) as $k => $controller) {

            $methods = $controller;
            $controllerName = $k;
            $controllerStringArr = explode('\\', $k);
            $controllerName =  end($controllerStringArr);
            $modelName = str_replace('Controller', '', $controllerName);
            $valuesToDelete = ['__construct'];
            foreach ($valuesToDelete as $valueToDelete) {
                $keyToDelete = array_search($valueToDelete, $methods);
                if ($keyToDelete !== false) {
                    unset($methods[$keyToDelete]);
                }
            }
            if (!in_array($modelName, $controllersToSpare)) {
                $controllersWithMethods[$modelName] = $methods;
            }
        }

        // return $controllersArr->toArray();

        // return $controllersWithMethods;

        // return $controllers;

        return [
            'controllers' => $controllersArr,
            'methods' => $controllersWithMethods
        ];
    }



    public function permissionGeneration()
    {
        $controllersWithName = [];
        $controllers = [];
        $methods = [];
        foreach (Route::getRoutes()->getRoutes() as $key => $route) {
            $action = $route->getAction();
            if (array_key_exists('controller', $action)) {
                $classNameA = $this->get_string_between($action['controller'], "Controllers\\", 'Controller@');
                // $className = substr($classNameA, strpos($classNameA, "\\") + 1);
                $className = substr($classNameA, strpos($classNameA, "\\") + 0);

                // $method = substr($action['controller'], strpos($action['controller'], "@") + 1);
                $method = substr($action['controller'], strpos($action['controller'], "@") + 1);
                if (!in_array($className, $controllersWithName)) {
                    $controllers[] = $className;
                }
                $methods[$className][] = $method;
                $methods[$className] = array_unique($methods[$className]);
            }
        }
        $controllers = array_unique($controllers);
        $controllers = array_filter($controllers, function ($var) {
            return (strpos($var, '\\') === false);
        });
        //$this->setPageTitle('Permission Generate', 'Generate new Permission');
        // return view('permission.permissions.generate', compact('controllers', 'methods'));

        return [
            'controllers' => $controllers,
            'methods' => $methods
        ];
    }

    public function get_string_between($string, $start, $end)
    {
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }

    public function get_string_last($string, $start)
    {
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, '', $ini) - $ini;
        return substr($string, $ini, $len);
    }
}
