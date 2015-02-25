<?php
namespace controller;
/**
 * Description of FormController
 *
 * @author lganne
 */
class FormController extends \controller\modelController
{
    
    
  public function adhesion()
  {
      
      if (isset($_POST))
      {
          $ent=new \modele\EntrepriseManager;
          $res=$ent->insert($_POST);
      }
      else
      {
          return "le formulaire est vide";
      }
      echo  '<h1>bonjour</h1>';
  }
  public function contact()
  {
      echo '<h1>bonjour</h1>';
  }
  
  public function verifFormEnt($data)
  {
      $mess="";
   //   if($data[])
      
  }
}
