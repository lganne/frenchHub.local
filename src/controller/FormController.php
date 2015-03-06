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
    
    // formulaire d'inscription
      public function inscription()
    {
          $template = $this->twig->loadTemplate('inscription.html.twig');
          echo $template->render(array("message2"=>NULL,'nomPays'=>$this->paysfr));
    }
    
  public function adhesion()
  {
       $template = $this->twig->loadTemplate('inscription.html.twig');
       if (isset($_POST))
      {
          $ent=new \modele\EntrepriseManager;
        $res=$ent->insert($_POST);
       // $res contient l'id de l'entreprise qu'on vient d'enregistrer si faux =0
          if ($res!=0)
          { // enregistrement de la formule choisit
              $sub=new \modele\SubscriptionManager();
              $tabSub=array('ent'=>$res,'formule1'=>0,'formule2'=>0,'formule3'=>0,'formule4'=>0);
              switch ($_POST['option'])
              {
                  case 1:
                      $tabSub['formule1']=1;
                      break;
                  case 2:
                      $tabSub['formule2']=1;
                      break;
                  case 3:
                      $tabSub['formule3']=1;
                      break;
                  case 4:
                      $tabSub['formule4']=1;
                      break;
                  }
              $rep =$sub->insert($tabSub);
              if($rep==false)
                  {
                        $mess="votre inscription n'a pas été enregistré";
                        $ent->delete($rep); // si la formule n'a pas été enregistrer, on supprime l'enregistrement de l'entreprise
                        goto sort;
                  }
                 $mess="Votre adhesion a bien été enregistré ".PHP_EOL;
                  // si la newsletter general a été cocher, on enregistre l'entreprise dans la table newsletter
                 if (isset($_POST['newsLetter']))
                 {
                      $this->newsletter($res);
                 }
                  $retour= \service\DiverService::generationLogin("entreprise", $_POST['nom'], $_POST['email'],$res);
               if ($retour!=false)
               {
                    $mess.="votre login est ".$_POST['nom']."  votre mot de passe est ".$retour.PHP_EOL
                       ."\n Vous allez recevoir un mail de confirmation de vos indentifiant ainsi que votre facture";
               }    
               else
               {   $mess= " Un probleme est survenue lors de la generation du mot de passe. Veuillez contacter votre conseiller";}
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
      sort:
        echo $template->render(array("message2"=>$mess,'nomPays'=>$this->paysfr));
  }
  
  public function newsletter($ident)
  {
      $news=new \modele\NewsLetterManager();
      $tab=array('ent'=>$ident,'news1'=>0,'news2'=>0,'news3'=>0,'news4'=>0,'news5'=>0,'news6'=>0);
     if(isset($_POST['news1'])) { $tab['news1']=1;}
      if(isset($_POST['news2']))  $tab['news2']=1;
       if(isset($_POST['news3']))  $tab['news3']=1;
        if(isset($_POST['news4']))  $tab['news4']=1;
         if(isset($_POST['news5']))  $tab['news5']=1;
          if(isset($_POST['news6']))  $tab['news6']=1;
          
      $news->insert($tab);
      
  }
  
  public function recontacter()
  {
        $template = $this->twig->loadTemplate('Detail/recontacter.html.twig');
        echo $template->render(array('message3'=>NULL,'nomPays'=>$this->paysfr));
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
        echo $template->render(array("message3"=>$mess,'nomPays'=>$this->paysfr));
  }
  
  public function verifFormEnt()
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
        $template = $this->twig->loadTemplate('Detail/Devis.html.twig');
        $mess=null;
      if(empty($_POST))
      {
          $mess="Le formulaire est vide.recommencez";
          goto sortie;
      }
      $data=[] ;  
      $option="";
      foreach($_POST as $key => $value)
      {
          if(substr($key,0,6)  != "option")
          {
               $data[$key]=$value;
           }
           else 
           {
                $option.=$value.",";
            }
        }
        $data['option']=$option;
        
      $estimate=new \modele\EstimateManager();
       $retour=$estimate->insert($data);
       if ($retour !=false)
       {
           $mess="Votre demande de devis à bien été enregistré, il vous sera envoyée dans les 24 heures";
       }else
       {
           $mess=" Un probleme inattendus est survenus lors de l'enregistrement de votre demande. celle ci n'a pu être enregistrée";
       }
             sortie:
       echo $template->render(array('nomPays'=>$this->paysfr,'mess'=>$mess));
  }
}
