<?php
namespace controller;
/**
 * Description of EntrepriseController
 *
 * @author lganne
 */
class EntrepriseController extends modelController
{
        protected $ent;
        
    public function __construct() 
  {
        
         parent::__construct();
      $rep=\service\DiverService::verifUser($_SESSION['user']);
      if( $rep==true)
      {
     
          if ($_SESSION['user'][5]==NULL)
          {
               header('Location: /');
               }
      }
      else
      {
          header('Location: /');
      }
      
      $this->ent=new \modele\EntrepriseManager();
      }
   
    public function homeEntreprise()
    {
       $template = $this->twig->loadTemplate('Entreprise.html.twig');
     
       $res=$this->ent->find($_SESSION['user'][2]);
             
         echo $template->render(array( 'session'   => $_SESSION['user'][1] , "donnee"=>$res) );
    }
}
