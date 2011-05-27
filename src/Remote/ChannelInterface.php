<?php
interface Remote_ChannelInterface
{
	function getName();
	function getAlias();
	function getDescription();

	/**
	 * @return Remote_PackagesInterface
	 */
	function getPackages();
}