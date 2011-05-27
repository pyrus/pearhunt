<?php
class Request
{
	protected $get   = array('format'=>'json');
	protected $post  = array();
	protected $files = array();

	function __construct($get = array(), $post = array(), $files = array())
	{
        $this->get   = $get + $this->get;
        $this->post  = $post + $this->post;
        $this->files = $files + $this->files;
	}

	function getRequestedModel()
	{
		return 'PackageSearch';
	}

	function getRequestedModelId()
	{
		if (isset($this->id)) {
			return $this->id;
		}
		return false;
	}

	function __isset($var)
	{
        if (isset($this->get[$var])
            || isset($this->post[$var])) {
            return true;
        }

        return false;
	}

	function __get($var)
	{
		if (isset($this->get[$var])) {
			return $this->get[$var];
		}
		if (isset($this->post[$var])) {
			return $var;
		}
		throw new Exception('Unknown request option');
	}

	public function getOptions()
	{
		return $this->get;
	}
}