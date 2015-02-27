<?php

namespace controller;
/**
 * Description of DefaultController
 *
 * @author lganne
 */
class DefaultController extends \controller\modelController
{
    
  
 protected  $paysfr;
 
    public function __construct() {
        parent::__construct();
        $pays=new \modele\PaysManager();
        $this->paysfr=$pays->nomPays('nom_fr_fr');
        
    }
    
    public function affiche()
    {
          $template = $this->twig->loadTemplate('index.html.twig');
    
          echo $template->render(array('nomPays'=>$this->paysfr));
         
       }
    
    
}
