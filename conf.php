<?php

$conf = array(
    'production' => array(
        'db_name' => 'items_list',
        'db_host' => 'localhost',
        'db_user' => 'root',
        'db_pass' => '',
        'development_mode' => false,
        'path_sys_template' => '/Template/base.twig',
        'path_static' => '/Template/static/',
        'path_user_template' => '/App/views',
        'user_var' => array(
            'project_name' => 'Wish List Manager',
            'project_static' => '/App/static',
            'security_key' => 'anySecurityKey'
        ),
    ),
    'development' => array(
        'db_name' => 'items_list',
        'db_host' => 'localhost',
        'db_user' => 'root',
        'db_pass' => 'root',
        'development_mode' => true,
        'path_sys_template' => '/Template/base.twig',
        'path_static' => '/Template/static/',
        'path_user_template' => '/App/views',
        'user_var' => array(
            'project_name' => 'Wish List Manager',
            'project_static' => '/App/static',
            'security_key' => 'anySecurityKey'
        ),
    )
);

return $conf['development'];

