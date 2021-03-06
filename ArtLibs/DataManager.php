<?php

namespace ArtLibs;

class DataManager
{
    private $data_manager;

    private $message;

    /**
     * DataManager constructor.
     * @param $conf
     */
    function __construct($conf)
    {
        $this->message = "";

        try {
            $data = new \PDO('mysql:host=' . $conf->getDbHost() . ';dbname=' . $conf->getDbName() . '', $conf->getDbUser(), $conf->getDbPass());
            $this->data_manager = new \FluentPDO($data);
            $this->data_manager->debug = false;
        } catch (\Exception $ex) {
            $this->message = "Database connection failed : " . $ex->getMessage();
        }
    }

    /**
     * @return mixed
     */
    public function getDataManager()
    {
        return $this->data_manager;
    }

    /**
     * @param mixed $data_manager
     * @return mixed
     */
    public function setDataManager($data_manager)
    {
        $this->data_manager = $data_manager;
        return $this->data_manager;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        if ($this->message != "") {
            return $this->message;
        } else {
            return false;
        }
    }

    /**
     * @param mixed $message
     * @return mixed
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this->message;
    }
}


/**
 * An open source web application development framework for PHP 5.
 * @author        ArticulateLogic Labs
 * @author        Abdullah Al Zakir Hossain, Email: aazhbd@yahoo.com
 * @copyright     Copyright (c)2009-2014 ArticulateLogic Labs
 * @license       MIT License
 */
