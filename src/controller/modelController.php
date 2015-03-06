<?php
namespace controller;
/**
 * Description of modelController
 *
 * @author lganne
 */
abstract class modelController {
     protected $twig;

     public function __construct() 
    {
        
       //  $var=new \service\DiverService();
        $this->twig=  \service\DiverService::twig();
    }
    
}
