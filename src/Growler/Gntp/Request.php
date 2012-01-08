<?php

namespace Growler\Gntp;

abstract class Request
{
    private $_method;
    private $_headers;
    private $_binaries;

    /**
     * @param string    $method    Request method
     */
    public function __construct($method)
    {
        $this->_method    = $method;
        $this->_headers   = array();
        $this->_binaries = array();
    }

    /**
     * @param string    $name    Header name
     * @param string    $value   Header value
     */
    public function setHeader($name, $value)
    {
        $this->_headers[$name] = mb_convert_encoding($value, 'UTF-8', 'auto');
    }

    public function __toString()
    {
        $message = "GNTP/1.0 " . $this->_method . " NONE\r\n";

        // Headers
        foreach ($this->_headers as $name => $value) {
            $message .= $name . ": " . $value ."\r\n";
        }

        // Body
        $message .= $this->_getBody();

        // Binaries
        foreach ($this->_binaries as $id => $resource) {
            $message .= "\r\n";
            $message .= "Identifier: " . $id . "\r\n";
            $message .= "Length: " . $resource->getBinarySize() . "\r\n\r\n";
            $message .= $resource->getBinaryData() . "\r\n";
        }

        $message .= "\r\n";

        return $message;
    }

    protected function _getBody()
    { 
        return "";
    }

    protected function _addResource($resource)
    {
        if (!$resource->hasBinary()) {
            return;
        }

        $this->_binaries[$resource->getBinaryId()] = $resource;
    }
}