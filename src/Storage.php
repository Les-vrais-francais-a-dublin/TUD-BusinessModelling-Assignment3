<?php

class Storage
{
    private $_storage_name;
    private $_content;

    public function __construct($storage_name)
    {
        $this->_storage_name = $storage_name;
    }
    public function readStorage()
    {
        try {
            $this->_content = json_decode(file_get_contents(__DIR__ . "/../storage/" . $this->_storage_name . ".stor", true));
        } catch (\Throwable $th) {
            $this->_content = array();
        }
    }
    public function writeStorage()
    {
        file_put_contents(__DIR__ . "/../storage/" . $this->_storage_name . ".stor", json_encode($this->_content));
    }
    public function getContent()
    {
        return $this->_content;
    }
    public function setContent($content)
    {
        $this->_content = $content;
    }
}
