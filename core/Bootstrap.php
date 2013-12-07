<?php

/**
* Mario Menjivar <mariomenjr@gmail.com>
* @mariomenjr
* Bootstrap class.
* It is responsible of calling the correct controler depending of url.
* Thursday 05, dic 2013
*/
class Bootstrap {

    function __construct(Request $request) {

        //Hicimos el request. Déjanos saber cuales son tus variables.
        //We did a request. Let us to know which are your variables.
        $controller = $request->controller(); //example: users
        $metod = $request->metod(); //example: edit
        $args = $request->args(); //

        $routeController = CONTROLLERS . $controller . PHP; //Ruta controlador. Controller route.

        //Verificamos la existencia del controlador, sino el controlador será error.
        //We verify if the controller exist, else the controller will be error.
        if (!is_readable($routeController)){
            $routeController = CONTROLLERS . 'error' . PHP; //Default Error
            $args = $controller;
            $controller = 'error';
        }
        
        //Carguemos el controlador adecuado.
        //Let´s charge the right controller.
        require_once $routeController;
        $controller = $controller . '_ct'; //Adding ctlr suffix
        $controller = new $controller();

        //Tiene que existir el objeto antes para poder verificar le método.
        //The object has to exist before to verify if it does exist.
        if (!method_exists($controller, $metod)) {
            $args = $this->controller . '/' . $metod; //To know which was the error.
            $metod = "index"; //Always this line is correct.
            require_once CONTROLLERS . 'error' . PHP;
            $controller = 'error' . '_ct'; //Adding ctlr suffix
            $controller = new $controller();
        }

        $controller->{$metod}($args); //Calling the method into the object.
    }
}