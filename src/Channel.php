<?php

class Channel extends Record
{
    public $id;
    public $name;
    public $alias;
    public $description;

    public function getTable()
    {
        return 'channels';
    }

    public function getPackages($options = array())
    {
        return new Channel_Packages($this, $options);
    }

    function __toString()
    {
        return $this->name;
    }

}