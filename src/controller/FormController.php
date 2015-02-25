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
       $template = $this->twig->loadTemplate('index.html.twig');
       if (isset($_POST))
      {
          $ent=new \modele\EntrepriseManager;
          $res=$ent->insert($_POST);
          if ($res==true)
          {
              $mess="Votre adhesion a bien été enregistré";
           }
        else
         {
                 $mess="un probleme est survenue lors de l'enregistrement du formulaire.<br>Veuillez recommencer";
          }
      }
      else
      {
          $mess="le formulaire est vide";
      }
        echo $template->render(array("message2"=>$mess));
  }
  public function contact()
  {
      $template = $this->twig->loadTemplate('index.html.twig');
       if (isset($_POST))
      {
          $info=new \modele\informationManager();
          $res=$info->insert($_POST);
          if ($res==true)
          {
              $mess="Votre demande a bien été enregistré";
           }
        else
         {
                 $mess="un probleme est survenue lors de l'enregistrement du formulaire.<br>Veuillez recommencer";
          }
      }
      else
      {
          $mess="le formulaire est vide";
      }
        echo $template->render(array("message3"=>$mess));
  }
  
  public function verifFormEnt($data)
  {
      $mess="";
   //   if($data[])
      
  }
}
