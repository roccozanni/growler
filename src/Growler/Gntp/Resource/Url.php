<?php 

namespace Growler\Gntp\Resource;

class Url extends \Growler\Gntp\Resource
{

    private $_url;

    public function __construct($url) 
    {
        $this->_url = $url;
    }

    public function isValid()
    {
        return true;
    }

    public function getUniqueId()
    {
        return $this->_url;
    }
}