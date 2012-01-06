<?php

namespace Growl;

class Connection
{
    private $_procotol;
    private $_host;
    private $_port;
    private $_handle;
    private $_autoconnect;

    public function __construct($protocol, $host, $port, $autoconnect = true)
    {
        $this->_protocol    = $protocol;
        $this->_host        = $host;
        $this->_port        = $port;
        $this->_autoconnect = $autoconnect;
        $this->_handle      = null;
    }

    public function connect()
    { 
        $this->_handle = fsockopen($this->_protocol . '://' . $this->_host, $this->_port);

        if (!$this->_handle) {
            throw new Exception("Unable to open connetion");
        }
    }

    public function send($message)
    {
        // Check handle and try to auto connect if needed
        if (!$this->_handle)
        {
            if (!$this->_autoconnect) {
                throw new Exception("You must call connect() method before trying to send a message");
            }
            $this->connect();
        }

        // Write data on the network stream
        for ($total = 0; $total < strlen($message); $total += $written)
        {
            $written = fwrite($this->_handle, substr($message, $total));
            if ($written === false)
            {
                $this->disconnect();
                throw new Exception("Unable to send message: write to the socket failed");
            }
        }
    }

    public function disconnect()
    {
        fclose($this->_handle);
    }
}