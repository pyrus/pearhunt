<?php

use PEAR2\Pyrus;

class Remote_PyrusChannel implements Remote_ChannelInterface
{
	/**
	 * The actual channel obj
	 *
	 * @var \PEAR2\Pyrus\ChannelFile
	 */
	protected $channel;

	function __construct($name)
	{
		$this->channel = new \PEAR2\Pyrus\ChannelFile($name, false, true);
	}

	function getAlias()
	{
		return $this->channel->alias;
	}

    function getName()
    {
        return $this->channel->name;
    }

    function getDescription()
    {
        return $this->channel->description;
    }
}