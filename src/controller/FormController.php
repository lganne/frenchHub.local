<?php
namespace controller;
/**
 * Description of FormController
 *
 * @author lganne
 */
class FormController extends \controller\modelController
{
  protected  $paysfr;
    public function __construct() {
        parent::__construct();
        $pays=new \modele\PaysManager();
        $this->paysfr=$pays->nomPays('nom_fr_fr');
        
    }
  public function adhesion()
  {
       $template = $this->twig->loadTemplate('index.html.twig');
       if (isset($_POST))
      {
          $ent=new \modele\EntrepriseManager;
          $res=$ent->insert($_POST);
         
       // $res contient l'id de l'entreprise qu'on vient d'enregistrer si faux =0
          if ($res!=0)
          {
              $mess="<p>Votre adhesion a bien été enregistré </p>";
                  $var=new \service\DiverService();
                 $motPass= //  $var->generateRandomString(8);
                 $salt=$var->generateRandomString(30);
               $token=$var->generateRandomString(50);
               // on rajoute le salt au mot de passe
               $password=$salt.$motPass.$salt;
               // on crypte le mot de passe
               $pwd=$var->codepassword($password);
               $role='entreprise';
               $donne=array('ident'=>$res,'username'=>$_POST['contact'],'password'=>$pwd,'email'=>$_POST['email'],'salt'=>$salt,'token'=>$token,'role'=>$role);
               $user=new \modele\UserManager();
               $rep=$user->save($donne);
               $mess.="<p>votre login est ".$_POST['contact']."/n votre mot de passe est ".$motPass
                       ."<br> Vous allez recevoir un mail de confirmation de vos indentifiant ainsi que votre facture</p> ";
                       
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
  
  public function devis()
  {
    //  $tabPays=$this->pays->nomPays('nom_fr_fr');
       $template = $this->twig->loadTemplate('Detail/Devis.html.twig');
      
        echo $template->render(array('nomPays'=>$this->paysfr));
  }
  
  
  public function devisEnregistrement()
  {
      
  }
}
