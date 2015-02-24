<?php

return [
    
    'DefaultController_affiche' => [
        'pattern' => '\/',
        'connect' => 'controller\DefaultController:affiche'
    ],
   
        'UserController_inscription' => [
        'pattern' => '\/inscription',
        'connect' => 'controller\UserController:inscription'
      
    ],
       'UserController_login' => [
        'pattern' => '\/login',
        'connect' => 'controller\UserController:login'
     ],
    'UserController_loginValidation' => [
        'pattern' => '\/loginValidation',
        'connect' => 'controller\UserController:loginValidation'
     ],
     'UserController_logout' => [
        'pattern' => '\/logout',
        'connect' => 'controller\UserController:logout'
     ],
    
       
];