<?php 

namespace Growler\Gntp;

abstract class Resource
{
    abstract public function getUniqueId();

    public function isValid()
    {
        return false;
    }

    public function hasBinary()
    {
        return false;
    }

    public function getBinaryId()
    {
        return "";
    }

    public function getBinarySize()
    {
        return 0;
    }

    public static function build($uri)
    {
        if (preg_match('/^https?:\/\/.*/', $uri)) {
            return new Resource\Url($uri);
        }

        return new Resource\File($uri);
    }
}