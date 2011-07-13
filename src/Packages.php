<?php
abstract class Packages extends DBResultIterator
{
	function current()
	{
		$data    = parent::current();
		$package = new Package();
		$package->synchronizeWithArray($data);
		return $package;
	}
}