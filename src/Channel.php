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

    public function getPackages()
    {
    	$channel_file = new \PEAR2\Pyrus\ChannelFile($this->name, false, true);
        $channel = new \PEAR2\Pyrus\Channel($channel_file);
        $config = \PEAR2\Pyrus\Config::current();

        // Ensure the channel currently exists in the registry
        if (!$config->channelregistry->exists($channel->name)) {
            $config->channelregistry->add($channel);
        }
    	return new Packages($config->channelregistry[$this->name]);
    }

}