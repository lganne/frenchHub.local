<?php

namespace controller;
/**
 * Description of DefaultController
 *
 * @author lganne
 */
class DefaultController extends \controller\modelController
{
    
  protected $entite;

    
    public function affiche()
    {
          $template = $this->twig->loadTemplate('index.html.twig');
    
          echo $template->render(array());
         
       }
    
    
}
