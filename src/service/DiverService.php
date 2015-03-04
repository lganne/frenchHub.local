<?php
namespace service;
/**
 * Description of DiverService
 *
 * @author lganne
 */
class DiverService {
    
    static function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++)
        {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
    return $randomString;
    }
    
    static function codepassword($motpasse)
    {
//        $i=0;
//        while($i<30)
//        {
            $motpasse=  sha1($motpasse);
//            $i++;
//        }
        return $motpasse;
    }
    /**
     * 
     * @param type $tableau de Session user
     * @return boolean
     * verif si les element du tableau de session sont valide
     */
    static function verifUser($tabSession)
    {
        $user=new \modele\UserManager();
        $result=$user->find($tabSession[0]);
          
         foreach ($result as $unResult)
        {
                if($unResult->username==$tabSession[1]  && $unResult->token==$tabSession[4] && $unResult->role==$tabSession[5] && $unResult->isActif==1)
                {
                    return true;
                }
            else
                { 
                return false;
                }
        }
    }
    
         static function twig ()
         {
             include_once  __DIR__ . '/../../twig/lib/Twig/Autoloader.php';

                \Twig_Autoloader::register();

                $loader = new \Twig_Loader_Filesystem('./../templates'); // Dossier contenant les templates

                $twig = new \Twig_Environment($loader, array(

                  'cache' => false

                ));
                return $twig;
         }
       
    public function generationLogin($role,$nom,$email,$ident,$idSalarier=NULL)
    {
                  $motPass= $this->generateRandomString(8);
                 $salt=$this->generateRandomString(30);
               $token=$this->generateRandomString(50);
                $password=$salt.$motPass.$salt;
               // on crypte le mot de passe
               $pwd=$this->codepassword($password);
                $user=new \modele\UserManager();
                $nom=$this->existeLog($nom, $user);
                 
                 $donne=array('ident'=>$ident,'idSalarier'=>$idSalarier,'username'=>$nom,'password'=>$pwd,'email'=>$email,'salt'=>$salt,'token'=>$token,'role'=>$role);    
                 $rep=$user->save($donne);
               if ($rep!=null)
               {
                   return array('username'=>$nom,'motpass'=>$motPass);
               }
               else
               {
                   return false;
               }
    }
    
    public function existeLog($nom,$user)
    {
         $existe=$user->query1arg("username", $nom);
               // on verif que l'username n'existe pas deja, si oui on en créer un nouveau en rajoutant une incrementation au nom
               $i=2;
               while (!empty($existe))
               {
                   $nom=$nom.$i;
                    $existe=$user->query1arg("username", $nom);
                    $i++;
               }   
               return $nom;
    }
}
