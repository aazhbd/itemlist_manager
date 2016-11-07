<?php

$routes = array(
    'urls' => array(
        '' => '/controller/Views/viewHome',
        '/home' => '/controller/Views/viewHome',

        '/login' => '/controller/Views/viewLogin',
        '/logout' => '/controller/Views/viewLogout',
        '/signup' => '/controller/Views/viewSignup',

        '/items' => '/controller/Views/viewItemList',
        '/item/(?<opt>[A-Za-z_][A-Za-z0-9_]*)/(?<aid>\d+)' => '/controller/Views/viewItem',

        '/add/(?<opt>[A-Za-z_][A-Za-z0-9_]*)/(?<aid>\d+)' => '/controller/Views/viewAddItem',
        '/remove/(?<opt>[A-Za-z_][A-Za-z0-9_]*)/(?<aid>\d+)' => '/controller/Views/viewRemoveItem',

    )
);

return $routes['urls'];
