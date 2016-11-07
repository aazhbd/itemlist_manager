<?php

use ArtLibs\Application;
use ArtLibs\Controller;
use ArtLibs\Item;
use ArtLibs\User;
use Symfony\Component\HttpFoundation\File\UploadedFile;


class Views extends Controller
{
    /**
     * @param $params
     * @param $app
     */
    public function viewHome($params, Application $app)
    {
        $app->setTemplateData(array(
            'title' => 'Home',
            'page_title' => 'Home'
        ));

        if ($app->getRequest()->getMethod() == "POST") {
            $email = $app->getRequest()->request->get('email');
            $pass = $app->getRequest()->request->get('password');

            $user = new User($app, $email, $pass);

            if (!$user->isAuthenticated()) {
                $app->setTemplateData(array('content_message' => 'Login unsuccessful, try again.'));
                $this->display($app, 'frm_login.twig');
                return;
            } else {
                $app->setTemplateData(array('content_message' => 'Login successful.'));
            }
        }

        $user_info = $app->getSession()->get('user_info');

        if ($user_info['utype'] == 1) {
            $this->display($app, 'uhome.twig');
            return;
        }

        $app->setTemplateData(array('body_content' => 'Home message'));
        $this->display($app, 'home.twig');
    }

    public function viewItemList($params, Application $app)
    {
        $app->setTemplateData(array(
            'title' => 'Wish Items List',
        ));

        $user_info = $app->getSession()->get('user_info');
        if ($user_info['utype'] != 1) {
            $app->setTemplateData(array('content_message' => 'Not found or accessible'));
            $this->display($app, 'home.twig');
            return;
        }

        if (isset($params[2])) {
            $action = $params[1];
            $id = $params[2];

            if ($action == "enable" || $action == "disable") {
                $app->setTemplateData(array(
                    'content_message' => (Item::setState(($action == "enable") ? 0 : 1, $id,
                        $app)) ? 'Item is ' . $params[1] . 'd.' : 'State change failed'
                ));
            }
        }

        if ($app->getRequest()->getMethod() == "POST") {
            $item = array('title' => trim($app->getRequest()->request->get('title')));
            if (Item::addItem($item, $app)) {
                $app->setTemplateData(array('content_message' => 'New Item successfully added'));
            } else {
                $app->setTemplateData(array('content_message' => 'New Item save failed'));
            }
        }

        $app->setTemplateData(array('items' => Item::getItems($app)));

        $this->display($app, 'list_items.twig');
    }

    /**
     * @param $params
     * @param Application $app
     */
    public function viewItems($params, Application $app)
    {
        if ($app->getRequest()->getMethod() == "POST") {
            Item::addItem(array('title' => trim($app->getRequest()->request->get('title'))), $app);
        }

        $this->jsonResponse($app, Item::getItems($app));
    }

    /**
     * @param $params
     * @param Application $app
     */
    public function viewItem($params, Application $app)
    {
        $id = (int)$params['aid'];

        if ($app->getRequest()->getMethod() == "PUT") {
            Item::updateItem($id, array('title' => trim($app->getRequest()->request->get('title'))), $app);
        }

        if ($app->getRequest()->getMethod() == "DELETE") {
            Item::deleteItem($id, $app);
        }

        $this->jsonResponse($app, Item::getItemById($id, $app));
    }

    public function viewLocation($params, Application $app)
    {
        $id = (int)$params['aid'];
        $loc = $params['loc'];

        if ($app->getRequest()->getMethod() == "PUT") {
            Item::updateItem($id, array('location' => $loc), $app);
        }

        $this->jsonResponse($app, Item::getItemById($id, $app));
    }

    /**
     * @param $params
     * @param $app
     */
    public function viewLogin($params, Application $app)
    {
        $app->setTemplateData(array('title' => 'Login'));

        if ($app->getRequest()->getMethod() == "POST") {
            $user_data = array(
                'email' => trim($app->getRequest()->request->get('email')),
                'pass' => trim($app->getRequest()->request->get('password')),
                'firstname' => trim($app->getRequest()->request->get('name')),
                'gender' => trim($app->getRequest()->request->get('gender')),
                'date_ofbirth' => trim($app->getRequest()->request->get('birthdate')),
                'ustatus' => 1,
            );

            if (User::userExists($user_data['email'], $app)) {
                $app->setTemplateData(array(
                    'title' => 'Signup',
                    'content_message' => 'Signup was unsuccessful, user with email ' . $user_data['email'] . ' already exists. Try different email'
                ));
                $this->display($app, 'frm_signup.twig');
                return;
            }

            if (!User::addUser($user_data, $app)) {
                $app->setTemplateData(array(
                    'title' => 'Signup',
                    'content_message' => 'Signup was unsuccessful, try again.',
                ));
                $this->display($app, 'frm_signup.twig');
                return;
            }

            $app->setTemplateData(array(
                'title' => 'Login',
                'content_message' => 'The user is successfully added and can login',
            ));
        }

        $this->display($app, 'frm_login.twig');
    }

    /**
     * @param $params
     * @param $app
     */
    public function viewSignup($params, Application $app)
    {
        $app->setTemplateData(array('title' => 'Signup',));
        $this->display($app, 'frm_signup.twig');
    }

    /**
     * @param $params
     * @param $app
     */
    public function viewLogout($params, Application $app)
    {
        $app->setTemplateData(array('title' => 'Logout'));

        if ($app->getSession()->get('is_authenticated') && User::clearSession($app)) {
            $app->setTemplateData(array('content_message' => 'The user successfully logged out.'));
        }

        $this->display($app, 'frm_login.twig');
    }
}

/**
 * An open source web application development framework for PHP 5.
 * @author        ArticulateLogic Labs
 * @author        Abdullah Al Zakir Hossain, Email: aazhbd@yahoo.com
 * @copyright     Copyright (c)2009-2016 ArticulateLogic Labs
 * @license       MIT License
 */