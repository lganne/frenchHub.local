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
       $mess=(!empty($_SESSION['message'])) ?  $_SESSION['message'][0] : array();
       //var_dump($mess);
       
        $sal=new \modele\EmployeeManager();
         $listeSal= $sal->ListeEnt($_SESSION['user'][2]);
         $_SESSION['message']=[];
         echo $template->render(array( 'session'   => $_SESSION['user'][1] , "donnee"=>$res,"mess"=>$mess,"listeSal"=>$listeSal));
    }
    
      public function ajoutSalarie()
        {
          $salarie=new \modele\EmployeeManager();
            $idsalarie=$salarie->insert($_POST);
            
          if($idsalarie!=false)
          {
             
             $identifiant= \service\DiverService::generationLogin("membre", $_POST['Nom'], $_POST['email'], $_POST['ident'],$idsalarie);
               array_push($_SESSION['message'],$identifiant);
          
           }
           
           header('location:/homeEntreprise');
           
           
        }
}
