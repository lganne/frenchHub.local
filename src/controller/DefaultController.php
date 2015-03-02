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
    
    public function home()
    {
          $template = $this->twig->loadTemplate('home.html.twig');
    
          echo $template->render(array());
         
       }
    
    public function affiche()
    {
          $template = $this->twig->loadTemplate('index.html.twig');
    
          echo $template->render(array('nomPays'=>$this->paysfr));
         
       }
       
       public function relocation($titre)
       {
            $template = $this->twig->loadTemplate('detail/Relocation.html.twig');
    
          echo $template->render(array('titre'=>$titre));
         
       }
     public function formation($titre)
       {
         
            $template = $this->twig->loadTemplate('detail/Formation.html.twig');
    
          echo $template->render(array('titre'=>$titre));
         
       }
    
}
