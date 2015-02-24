<?php

return [
    
    'DefaultController_affiche' => [
        'pattern' => '\/',
        'connect' => 'controller\DefaultController:affiche'
    ],
    'PricingController_detail' => [
        'pattern' => '\/pricing\/[a-zA-Z0-9\-_\.*]+\/(?P<id>[1-9][0-9]*)',
        'connect' => 'controller\PricingController:detail',
        'params' =>'id'
    ],
     'PricingController_liste' => [
        'pattern' => '\/pricing\/(?P<id>[1-9][0-9]*)',
        'connect' => 'controller\PricingController:liste',
         'params' =>'id'
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