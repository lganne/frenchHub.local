<?php

return [
    'DefaultController_home' => [
        'pattern' => '\/',
        'connect' => 'controller\DefaultController:home'
    ],
    'DefaultController_affiche' => [
        'pattern' => '\/accueil',
        'connect' => 'controller\DefaultController:affiche'
    ],
    'DefaultController_relocation' => [
        'pattern' => '\/relocation\/(?P<titre>[a-zA-Z0-9\-_\.*]+)',
        'connect' => 'controller\DefaultController:relocation',
          'params' =>'titre'
    ],
    'DefaultController_formation' => [
        'pattern' => '\/formation\/(?P<titre>[a-zA-Z0-9\-_\.*]+[1-9][0-9]*)',
        'connect' => 'controller\DefaultController:formation',
          'params' =>'titre'
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
     'FormController_recontacter' => [
        'pattern' => '\/recontacter',
        'connect' => 'controller\FormController:recontacter'
     ],
    
      'FormController_contact' => [
        'pattern' => '\/contact',
        'connect' => 'controller\FormController:contact'
     ],
    'FormController_inscription' => [
        'pattern' => '\/sinscrire',
        'connect' => 'controller\FormController:inscription'
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
     ],
    'EntrepriseController_homeEntreprise' => [
        'pattern' => '\/homeEntreprise',
        'connect' => 'controller\EntrepriseController:homeEntreprise'
     ],
     'MembreController_homeMembre' => [
        'pattern' => '\/homeMembre',
        'connect' => 'controller\MembreController:homeMembre'
     ]
       
    
       
];