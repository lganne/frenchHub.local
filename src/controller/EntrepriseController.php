<?php
namespace controller;
/**
 * Description of EntrepriseController
 *
 * @author lganne
 */
class EntrepriseController extends modelController
{
    public function __construct() 
  {
         parent::__construct();
      $rep=\service\DiverService::verifUser($_SESSION['user']);
      if( $rep==true)
      {
          if ($_SESSION['user'][3]!="entreprise")
          {
               header('Location: /');
          }
                
      }
      else
      {
          header('Location: /');
      }
      
   }
    public function homeEntreprise()
    {
       $template = $this->twig->loadTemplate('Entreprise.html.twig');
         echo $template->render(array( 'session'   => $_SESSION['user'][3] ) );
    }
}
