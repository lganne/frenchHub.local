<?php

namespace controller;
/**
 * Description of DefaultController
 *
 * @author lganne
 */
class DefaultController {
    
  protected $entite;
  protected $twig;

     public function __construct() 
    {
        //$this->entite = $entite;
         $var=new \service\DiverService();
        $this->twig=$var->twig();
    }
    
    public function affiche()
    {
          $template = $this->twig->loadTemplate('index.html.twig');
          //  echo $template->render(array(
//                  'moteur_name' => 'Twig'
//               ));  
          echo $template->render(array());
         
       }
    
    
}
