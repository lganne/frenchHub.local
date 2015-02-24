<?php
namespace controller;
/**
 * Description of UserController
 *
 * @author lganne
 */
class UserController 
{
    protected $user;
    protected $twig;
    
    public function __construct()
    {
       $this->user=new \modele\UserManager() ;
         $var=new \service\DiverService();
        $this->twig=$var->twig();
    }
    
    public function inscription()
    {
        $this->vue->form();
    }
    public function enregistrement()
    {
           if (!empty($_POST['login']) && !empty($_POST['mail']) && !empty($_POST['password'])  )
          {
              
               $var=new \service\DiverService();
               $salt=$var->generateRandomString(30);
               $token=$var->generateRandomString(50);
               // on rajoute le salt au mot de passe
               $password=$salt.$_POST['password'].$salt;
               // on crypte le mot de passe
               $pwd=$var->codepassword($password);
               $role='visitor';
             
               if(isset($_POST['role']))
               {
                   $role=$_POST['role'];
               }
               $data=array('username'=>$_POST['login'],'password'=>$pwd,'email'=>$_POST['mail'],'salt'=>$salt,'token'=>$token,'role'=>$role);
               $this->user->save($data);
           }
           $this->login();
    }
    
    public function login()
    {
        $this->vue->formLogin();
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
         
            $template = $this->twig->loadTemplate('Membre.html.twig');
                    echo $template->render(array( 'session'   => $user[1] ) );
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
