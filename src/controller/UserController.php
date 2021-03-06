<?php
namespace controller;
/**
 * Description of UserController
 *
 * @author lganne
 */
class UserController extends \controller\modelController
{
    protected $user;
    
    
    public function __construct()
    {
         parent::__construct();
       $this->user=new \modele\UserManager() ;
      
    }
    
    public function inscription()
    {
        $this->vue->form();
    }
    public function enregistrement($data)
    {
           if (!empty($data['name']) && !empty($data['email']) && !empty($data['password'])  )
          {
              
                $salt= \service\DiverService::generateRandomString(30);
               $token=$var->generateRandomString(50);
               // on rajoute le salt au mot de passe
               $password=$salt.$data['password'].$salt;
               // on crypte le mot de passe
               $pwd= \service\DiverService::codepassword($password);
               $role='visitor';
             
               if(isset($_POST['role']))
               {
                   $role=$_POST['role'];
               }
               $donne=array('username'=>$data['login'],'password'=>$pwd,'email'=>$data['mail'],'salt'=>$salt,'token'=>$token,'role'=>$role);
               $rep=$this->user->save($donne);
           }
           return $rep;
     }
 
   
    public function loginValidation()
    {
         $log=$_POST['login'];
        $pass=$_POST['password'];
        $rep=$this->user->veriflog($pass,$log);
        $user=array();
      
        if ($rep['reponse']==true)
        {
            foreach ($rep['donnee'] as $detail)
            {
              array_push($user,$detail);
            }
            $_SESSION['user']=$user;
    
             if ($user[5]=="entreprise")
            {  
               
                header('location:/homeEntreprise');
                
            }
            else
            {
                   header('location:/homeEmploye');
            }
          }
        else
        {
            $mess="Il y a une erreur dans le login ou le mot de passe";
            $template = $this->twig->loadTemplate('index.html.twig');
            $_SESSION['user']=[];
          echo $template->render(array('session' => NULL,'message'=>$mess));
        }
       
    }
    
    public function logout()
    {
           $template = $this->twig->loadTemplate('index.html.twig');
        $_SESSION['user']=[];
         echo $template->render(array('session' => NULL));
    }
    
   
    
    
}
