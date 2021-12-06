<?php


namespace Chene\Database;

use Scar\Database\Mysql;
use Scar\Database\Install;


class Database
{
    private $_config;
    private $_databases_install_engines;
    private $_databases_mysql_engines;

    public function __construct()
    {
        $this->_config = $this->readConf();
    }
    public function initEngines()
    {
        foreach ($this->_config as $key => $config)
            $this->_databases_mysql_engines[$key] = new Mysql($config);
    }
    private function readConf()
    {
        $config = parse_ini_file(__DIR__ . "/../../config/database.ini", true);
        return ($config);
    }
    public function install()
    {
        foreach ($this->_config as $key => $config) {
            $install_engine = new Install($config);
            $install_engine->install();
        }
    }
    public function uninstall()
    {
        foreach ($this->_config as $key => $config) {
            $install_engine = new Install($config);
            $install_engine->uninstall();
        }
    }
    public function getMysqlEngines()
    {
        return ($this->_databases_mysql_engines);
    }
}
