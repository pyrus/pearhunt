<?php

class Channel extends Record
{
	public $id;
	public $name;
	public $alias;

    public function getTable()
    {
        return 'channels';
    }

    public function getPackages()
    {
    	return new Packages(\PEAR2\Pyrus\Config::current()->channelregistry[$this->name]);
    }

}