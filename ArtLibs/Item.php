<?php

namespace ArtLibs;


class Item
{
    /**
     * @param $app
     * @param null $state
     * @return mixed
     */
    public static function getItems(Application $app, $state = null)
    {
        if (!isset($state)) {
            $query = $app->getDataManager()->getDataManager()->from("items");
        } else {
            $query = $app->getDataManager()->getDataManager()->from("items")->where(array("state" => $state));
        }

        try {
            $q = $query->fetchAll();
        } catch (\PDOException $ex) {
            $app->getErrorManager()->addMessage("Error : " . $ex->getMessage());
            return null;
        }

        return $q;
    }

    /**
     * @param $id
     * @param $app
     * @return mixed
     */
    public static function getItemById($id, Application $app)
    {
        try {
            $query = $app->getDataManager()->getDataManager()->from("items")
                ->where(array("id" => $id,))
                ->fetch();
        } catch (\PDOException $ex) {
            $app->getErrorManager()->addMessage("Error : " . $ex->getMessage());
            return null;
        }

        return $query;
    }

    /**
     * @param $title
     * @param $app
     * @return null
     */
    public static function getItemByTitle($title, Application $app)
    {
        try {
            $query = $app->getDataManager()->getDataManager()->from("items")
                ->where(array("catname" => $title,))
                ->fetch();
        } catch (\PDOException $ex) {
            $app->getErrorManager()->addMessage("Error : " . $ex->getMessage());
            return null;
        }

        return $query;
    }

    /**
     * @param array $item
     * @param Application $app
     * @return bool
     */
    public static function addItem($item = [], Application $app)
    {
        if (empty($item)) {
            return false;
        }

        $item['date_inserted'] = new \FluentLiteral('NOW()');

        try {
            $query = $app->getDataManager()->getDataManager()->insertInto('items')->values($item);
            //echo $query->getQuery();
            $executed = $query->execute(true);
        } catch (\PDOException $ex) {
            $app->getErrorManager()->addMessage("Error : " . $ex->getMessage());
            return false;
        }

        return $executed;
    }

    /**
     * @param $id
     * @param array $item
     * @param Application $app
     * @return bool
     */
    public static function updateItem($id, $item = array(), Application $app)
    {
        if (empty($item) || !isset($id)) {
            return false;
        }

        $item['date_updated'] = new \FluentLiteral('NOW()');

        try {
            $query = $app->getDataManager()->getDataManager()->update('items', $item, $id);
            $executed = $query->execute(true);
        } catch (\PDOException $ex) {
            $app->getErrorManager()->addMessage("Error : " . $ex->getMessage());
            return false;
        }

        return $executed;
    }

    /**
     * @param $id
     * @param Application $app
     * @return bool
     */
    public static function deleteItem($id, Application $app)
    {
        if (!isset($id)) {
            return false;
        }

        try {
            $query = $app->getDataManager()->getDataManager()->deleteFrom('items')->where('id', $id);
            $executed = $query->execute(true);
        } catch (\PDOException $ex) {
            $app->getErrorManager()->addMessage("Error : " . $ex->getMessage());
            return false;
        }

        return $executed;
    }

    /**
     * @param $state
     * @param $id
     * @param $app
     * @return bool
     */
    public static function setState($state, $id, Application $app)
    {
        if (!isset($state) || !isset($id)) {
            return false;
        }

        try {
            $query = $app->getDataManager()->getDataManager()
                ->update('items', array('state' => $state, 'date_updated' => new \FluentLiteral('NOW()')), $id);
            $executed = $query->execute(true);
        } catch (\PDOException $ex) {
            $app->getErrorManager()->addMessage("Error : " . $ex->getMessage());
            return false;
        }

        return $executed;
    }
}

/**
 * An open source web application development framework for PHP 5.
 * @author        ArticulateLogic Labs
 * @author        Abdullah Al Zakir Hossain, Email: aazhbd@yahoo.com
 * @copyright     Copyright (c)2009-2014 ArticulateLogic Labs
 * @license       MIT License
 */