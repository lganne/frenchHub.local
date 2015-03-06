<?php

namespace controller;
/**
 * Description of EntrepriseController
 *
 * @author lganne
 */
class EmployeController  extends modelController
{
    public function __construct() 
  {
         parent::__construct();
      $rep=\service\DiverService::verifUser($_SESSION['user']);
      if( $rep==true)
      {
          if ($_SESSION['user'][5]!="membre")
          {
               header('Location: /');
          }
                
      }
      else
      {
          header('Location: /');
      }
      
   }
    public function homeEmploye()
    {
       $template = $this->twig->loadTemplate('salarier.html.twig');
         echo $template->render(array( 'session'   => $_SESSION['user'][1] ) );
    }
}

