<?php

namespace Growler;

class Connection
{
    private $_procotol;
    private $_host;
    private $_port;
    private $_handle;
    private $_autoconnect;

    /**
     * @param   string  $protocol       The protocol (tcp, udp)
     * @param   string  $host           The ip address or the host name
     * @param   int     $port           The port number
     * @param   bool    $autoconnect    Automatically connect when needed
     */
    public function __construct($protocol, $host, $port, $autoconnect = true)
    {
        $this->_protocol    = $protocol;
        $this->_host        = $host;
        $this->_port        = $port;
        $this->_autoconnect = $autoconnect;
        $this->_handle      = null;
    }

    /**
     * Opens the remote connection
     */
    public function connect()
    { 
        if ($this->_handle) { 
            return;
        }
        
        $this->_handle = fsockopen($this->_protocol . '://' . $this->_host, $this->_port);

        if (!$this->_handle) {
            throw new \Exception("Unable to open connetion");
        }
    }

    /**
     * Read all data from the remote socket, until the EOF
     */
    public function consume()
    {
        if (!$this->_handle) {
            throw new Exception("Unable to read data: not connected");
        }

        $message = "";
        while (!feof($this->_handle)) {
            $message .= @fgets($this->_handle);
        }
        
        return $message;
    }

    /**
     * Send the given message over the wire
     *
     * @param   string  $message    The message to send
     */
    public function send($message)
    {
        // Check handle and try to auto connect if needed
        if (!$this->_handle)
        {
            if (!$this->_autoconnect) {
                throw new \Exception("You must call connect() method before trying to send a message");
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
                throw new \Exception("Unable to send message: write to the socket failed");
            }
        }
    }

    /**
     * Disconnect from the remote side
     */
    public function disconnect()
    {
        fclose($this->_handle);
        $this->_handle = null;
    }
}