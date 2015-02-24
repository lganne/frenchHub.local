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
                if($unResult->username==$tabSession[1]  && $unResult->token==$tabSession[2] && $unResult->role==$tabSession[3] )
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
       
    
}
