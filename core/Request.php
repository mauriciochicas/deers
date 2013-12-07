<?php
class Request {
    
    private $_controller;
    private $_metod;
    private $_args;
    
    public function __construct() {
        //Obtenemos la url. ?url='ESTO'
        //We get url. ?url='THIS'

        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = rtrim($url, '/');
        $url = explode('/', $url);

        //Asignamos las propiedades del Objeto Request.
        //We assign properties of Request Object
        $this->_controller = strtolower(array_shift($url));
        $this->_metod = strtolower(array_shift($url));
        $this->_args = $url;
    }
    
    //Los metodos get.
    //Get methods.
    public function controller() {
        $value = $this->_controller;
        return $value ? $value : 'index';
    }
    
    public function metod() {
        $value = $this->_metod;
        return $value ? $value : 'index';       
    }
    
    public function args() {
        $value = $this->_args;
        return $value;       
    }
}