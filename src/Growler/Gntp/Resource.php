<?php 

namespace Growler\Gntp;

abstract class Resource
{
    /**
     * Returns the resource unique id
     */
    abstract public function getUniqueId();

    /**
     * Checks if the resource is valid
     */
    public function isValid()
    {
        return false;
    }

    /**
     * Checks if the resource has binary content attached
     */
    public function hasBinary()
    {
        return false;
    }

    /**
     * Returns the id of the binary data
     */
    public function getBinaryId()
    {
        return "";
    }

    /**
     * Returns the size of the binary data
     */
    public function getBinarySize()
    {
        return 0;
    }

    /**
     * Builds a resource instance from a resource identifier. A resource identitifer can be:
     * - a local filepath
     * - a remote http/https uri
     *
     * @param string $identitfier   The resource identifier
     */
    public static function fromIdentifier($identitfier)
    {
        if (preg_match('/^https?:\/\/.*/', $identitfier)) {
            return new Resource\Url($identitfier);
        }

        return new Resource\File($identitfier);
    }
}