<?php

namespace controller;
/**
 * Description of EntrepriseController
 *
 * @author lganne
 */
class MembreController  extends modelController
{
    public function __construct() 
  {
         parent::__construct();
      $rep=\service\DiverService::verifUser($_SESSION['user']);
      if( $rep==true)
      {
          if ($_SESSION['user'][3]!="membre")
          {
               header('Location: /');
          }
                
      }
      else
      {
          header('Location: /');
      }
      
   }
    public function homeMembre()
    {
       $template = $this->twig->loadTemplate('Membre.html.twig');
         echo $template->render(array( 'session'   => $_SESSION['user'][3] ) );
    }
}

