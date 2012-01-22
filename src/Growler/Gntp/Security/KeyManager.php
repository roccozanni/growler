<?php

namespace Growler\Gntp\Security;

class KeyManager
{
    private static $_keys = array();

    public static function fromPassword($password)
    {
        if (!isset(self::$_keys[$password])) {
            self::$_keys[$password] = new Key($password);
        }

        return self::$_keys[$password];
    }
}