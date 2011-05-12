<?php
class Packages extends \PEAR2\Pyrus\Channel\RemotePackages
{
	function current()
	{
		$remote_package = parent::current();
		
		$channel = Channel::getByName($remote_package->channel);
		
		if (false === $package = Package::getByChannelAndName($channel, (string)$remote_package->name)) {
			$package = new Package();
		}
		
		$package->channel_id  = $channel->id;
		$package->name        = $remote_package->name;
		$package->description = $remote_package->description;
		return $package;
	}
}