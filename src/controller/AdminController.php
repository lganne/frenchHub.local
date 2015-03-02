<?php

namespace controller;
/**
 * Description of AdminController
 *
 * @author lganne
 */
class AdminController 
{
   private $view;
   
   public function __construct() 
  {
      $this->view=new \view\AdminVue() ;
      $rep=\service\DiverService::verifUser($_SESSION['user']);
      if( $rep==true)
      {
          if ($_SESSION['user'][3]!="administrator")
          {
              header("location:http://artspace.local/");
          }
      }
      else
      {
           header("location:http://artspace.local/");
      }
      
   }
    public function admin()
    {
        $this->view->home();
    }
    
   /************************************ user ****************************/
    public function supUsers($id)
    {
        
        $command=new \modele\CommandeManager();
        $tab=$command->commandUser($id);

        if(!empty($tab))
        {
            $_SESSION["mess"]=" Cette utilisateur a passé des commandes, vous ne pouvez pas le supprimer";
           $this->liste("User");
           exit;
        }
        $user=new \modele\UserManager();
        $data=$user->delete($id);
        $this->liste("User");
    }
    
     public function enregistrementUser()
    {
         
           
           if ($_POST['id']!=0)
           {
               $user=new \modele\UserManager();
               $user->update($_POST);
           }
         else 
             {
                $user=new UserController();
                 $user->enregistrement();
              }
           $this->liste("User");
         
     }
     
     //******************************   generique **********************************//
     //  fonction appeller part toute les entites d'admin 
     public function liste($entite)
    {
        $nom='modele\\'.$entite.'Manager';
        $user=new  $nom;             
        $data=$user->all();
        $nomVue="liste".$entite;
        $this->view->{$nomVue}($data);
    }
    
     public function form($id)
    {
          $chaine=explode("/",URI);
       
          $nom=  '\\modele\\'.$chaine[3].'Manager';
          $data=[];
           if($chaine[3]=="Produit")
           {
               $rub=new \modele\RubriqueManager();
               array_push($data, $rub->all());
           }
           
        if($id!=0)  // modification
        {
            $rub=new $nom;
            array_push( $data,$rub->find($id));
        }
        
        $nomVue="form".$chaine[3];
        $this->view->$nomVue($data);
    }
    
    /******************************************  Rubrique **********************************************/
    
    public function supRubrique($id)
    {

        $produit=new \modele\ProduitManager();
       $tabprod= $produit->findby($id);
        if(!empty($tabprod))
        {
            $_SESSION["mess"]=" Cette rubrique a des produits associé, vous ne pouvez pas le supprimer";
           $this->liste("Rubrique");
           exit;
        }
              $entite=new \modele\RubriqueManager();
            $data=$entite->delete($id);
             $this->liste("Rubrique");
    }
    
    
    public function rubEnregistrement()
    {
       $rub=new \modele\RubriqueManager();
       // modification  
       if ($_POST['id']!=0)
       {
           $rub->update($_POST['id'], $_POST['titre']);
         }
         //ajout
     else
       {
            $rub->insert($_POST['titre']) ;
       }
        $this->liste("Rubrique");
    }
    
    
    /************************************* Produit **********************************/
     
    
    
    
     public function ProduitEnregistrement()
    {
        $_POST['reference']= str_replace(" ","_",$_POST['reference']);
        $_POST['reference']= str_replace("é","é",$_POST['reference']);
        $_POST['reference']= str_replace("è","e",$_POST['reference']);
        $_POST['reference']= str_replace("ê","e",$_POST['reference']);
        $_POST['reference']= str_replace(" ë","e",$_POST['reference']);
        $_POST['reference']= str_replace("à","a",$_POST['reference']);
        $_POST['reference']= str_replace("'","_",$_POST['reference']);
        
       $rub=new \modele\ProduitManager();
       // modification  
       if ($_POST['id']!=0)
       {
           $rub->update($_POST);
         }
         //ajout
     else
       {
            $rub->insert($_POST) ;
       }
        $this->liste("Produit");
    }
    
     public function supProduit($id)
    {
            $entite=new \modele\ProduitManager();
            $data=$entite->delete($id);
            $this->liste("Produit");
    }
    
   /***************************************** commande ******************************/
    
    public function listeCommande()
    {
        $cde=new \modele\CommandeManager();
                
        $data=$cde->allUser();
       //var_dump($data);
       $this->view->listeCommande($data);
    }
    
    public function cdeEnregistrement()
      {
    
          $cde=new \modele\CommandeManager();
          $cde->statusUpdate($_POST['id'], $_POST['status']);
            $this->listeCommande();
      }
    
}
   