<?php 

namespace Growler\Gntp\Resource;

class File extends \Growler\Gntp\Resource
{

    private $_path;
    private $_exists;
    private $_hash;
    private $_size;

    public function __construct($path) 
    {
        $this->_path   = $path;
        $this->_exists = file_exists($path);
        $this->_hash   = md5_file($path);
        $this->_size   = filesize($path);
    }

    public function isValid()
    {
        return $this->_exists;
    }

    public function getUniqueId()
    {
        return "x-growl-resource://" . $this->_hash;
    }

    public function hasBinary()
    {
        return $this->_exists;
    }

    public function getBinaryId()
    {
        return $this->_hash;
    }

    public function getBinarySize()
    {
        return $this->_size;
    }

    public function getBinaryData()
    {
        return file_get_contents($this->_path);
    }
}