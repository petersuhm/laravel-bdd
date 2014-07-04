<?php

namespace Suhm\Support;

trait Mutable
{
    public function __get($name)
    {
        $method = "get" . ucfirst($name);

        if (method_exists($this, $method))
        {
            return $this->$method();
        }

        if (isset($this->$name))
        {
            return $this->$name;
        }
    }

    public function __set($name, $value)
    {
        $method = "set" . ucfirst($name);

        if (method_exists($this, $method))
        {
            return $this->$method($value);
        }

        if (array_key_exists($name, get_object_vars($this)))
        {
            $this->$name = $value;
        }
    }
}
