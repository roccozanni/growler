<?php

namespace Growler\Gntp;

abstract class Request
{
    private $_method;
    private $_headers;

    public function __construct($method)
    {
        $this->_method  = $method;
        $this->_headers = array();
    }

    public function setHeader($name, $value)
    {
        $this->_headers[$name] = mb_convert_encoding($value, 'UTF-8', 'auto');
    }

    public function __toString()
    {
        $message = "GNTP/1.0 " . $this->_method . " NONE\r\n";

        foreach ($this->_headers as $name => $value) {
            $message .= $name . ": " . $value ."\r\n";
        }

        $message .= $this->_getBody();

        $message .= "\r\n\r\n";

        return $message;
    }

    protected function _getBody()
    { 
        return "";
    }
}