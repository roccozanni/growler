<?php

namespace Growler\Gntp\Security;

class Key
{
    private $_algorithm = null;
    private $_key       = null;
    private $_hash      = null;
    private $_salt      = null;

    public function __construct($password)
    {
        $password  = mb_convert_encoding($password, 'UTF-8', 'auto');
        
        $saltVal   = mt_rand(268435456, mt_getrandmax());
        $saltHex   = dechex($saltVal);
        $saltBytes = pack("H*", $saltHex);

        $passHex   = bin2hex($password);
        $passBytes = pack("H*", $passHex);
        $keyBasis  = $passBytes . $saltBytes;

        $this->_algorithm   = "SHA1";
        $this->_key         = hash(strtolower($this->_algorithm), $keyBasis, true);
        $this->_hash        = hash(strtolower($this->_algorithm), $this->_key);
        $this->_salt        = $saltHex;
    }

    public function getAlgorithm()
    {
        return $this->_algorithm;
    }

    public function getKey()
    {
        return $this->_key;
    }

    public function getHash()
    {
        return $this->_hash;
    }

    public function getSalt()
    {
        return $this->_salt;
    }
}