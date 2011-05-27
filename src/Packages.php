<?php
class Packages extends LimitIterator
{
	function current()
	{
		$data    = parent::current();
		$package = new Package();
		$package->synchronizeWithArray($data);
		return $package;
	}
}