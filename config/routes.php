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
      'FormController_contact' => [
        'pattern' => '\/contact',
        'connect' => 'controller\FormController:contact'
     ],
     'FormController_adhesion' => [
        'pattern' => '\/adhesion',
        'connect' => 'controller\FormController:adhesion'
     ],
     'FormController_devis' => [
        'pattern' => '\/devis',
        'connect' => 'controller\FormController:devis'
     ],
    'FormController_devisEnregistrement' => [
        'pattern' => '\/devisEnregistrement',
        'connect' => 'controller\FormController:devisEnregistrement'
     ]
       
    
       
];