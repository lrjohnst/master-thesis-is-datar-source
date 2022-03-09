<?php
/**
 * DevTools
 *
 * PHP version: 8.0
 *
 * @link  			https://github.com/lrjohnst/master-thesis-is-source
 * @since   		v1.1
 *
 * Example uses
 *
 *   I work on XAMPP and I have no database credentials:
 *   $db = DevTools::connectDevDB(); // Defaults to localhost and empty database name, user and password
 *
 *   I enter my database credentials manually in my script:
 *   $db = DevTools::connectDevDB('database_name', 'username', 'password', 'host'); // Custom database object is loaded
 *
 *   I use the .env file in my application's root folder:
 *   $dev_tools = new DevTools(); // Constructor class is called, .env is loaded
 *   $db = $dev_tools->connectDevDB(); // Database object is created with data from .env
 *
 *   I use the .env file in my application's root folder, but I want to set a different environment:
 *   $dev_tools = new DevTools('_environmentname'); // Give environment name as string as first parameter
 *   $db = $dev_tools->connectDevDB(); // Database object is created with data from .env
 *
 */

class DevTools
{

    /* Set default database values */
    private $environment = ''; // ['_sandbox', '_production']
    private $database_name = '';
    private $database_user = '';
    private $database_pass = '';
    private $database_host = '127.0.0.1';

    /**
     * DevTools constructor.
     */
    public function __construct($environment = '') {

        /* Pass database credentials from .env to object instance */
        $this->set_environment($environment);
        $this->set_database_name($_ENV['db_name' . $this->environment]);
        $this->set_database_user($_ENV['db_user' . $this->environment]);
        $this->set_database_pass($_ENV['db_pass' . $this->environment]);
        $this->set_database_host($_ENV['db_host' . $this->environment]);
    }

    /**
     * @param string $environment
     */
    private function set_environment($environment = '') {
        !$environment ? $environment = $_ENV['environment'] : null; // If no parameter given, take from .env
        $this->environment = $environment;
    }

    /**
     * @param $db_name
     */
    private function set_database_name($db_name) {
        $this->database_name = $db_name;
    }

    /**
     * @param $db_user
     */
    private function set_database_user($db_user) {
        $this->database_user = $db_user;
    }

    /**
     * @param $db_pass
     */
    private function set_database_pass($db_pass) {
        $this->database_pass = $db_pass;
    }

    /**
     * @param $db_host
     */
    private function set_database_host($db_host) {
        $this->database_host = $db_host;
    }

    /**
     * @param string $strName
     * @param string $strUser
     * @param string $strPass
     * @param string $strHost
     * @return mysqli|string
     */
    public function connectDevDB($strName = '', $strUser = '', $strPass = '', $strHost = '') {

        /* Initialise variables */
        $strName != '' ? $strName = $strName : $strName = $this->database_name;
        $strUser != '' ? $strUser = $strUser : $strUser = $this->database_user;
        $strPass != '' ? $strPass = $strPass : $strPass = $this->database_pass;
        $strHost != '' ? $strHost = $strHost : $strHost = $this->database_host;

        /* Make connection */
        $mysqli = new mysqli($strHost, $strUser, $strPass, $strName);

        /* Check connection */
        if ($mysqli -> connect_errno) {
            $return = "Failed to connect to MySQL: " . $mysqli -> connect_error;
            return $return;
        }
        else {
            return $mysqli;
        }
    }
}
