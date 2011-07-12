<?php
/**
 * Abstract the request object
 * 
 * PHP version 5
 * 
 * @category  Utilities
 * @package   pearhunt
 * @author    Brett Bieber <brett.bieber@gmail.com>
 * @copyright 2011 Brett Bieber
 * @license   http://www1.unl.edu/wdn/wiki/Software_License BSD License
 * @link      http://pear2.php.net/
 */

/**
 * Abstract the request object
 * 
 * PHP version 5
 * 
 * @category  Utilities
 * @package   pearhunt
 * @author    Brett Bieber <brett.bieber@gmail.com>
 * @copyright 2011 Brett Bieber
 * @license   http://www1.unl.edu/wdn/wiki/Software_License BSD License
 * @link      http://pear2.php.net/
 */
class Request
{
	protected $get    = array('format'=>'json');
	protected $post   = array();
	protected $files  = array();
    protected $server = array();


    protected $model = 'PackageSearch';

    /**
     * __construct
     *
     * @param array $get    See $_GET
     * @param array $post   See $_POST
     * @param array $files  See $_FILES
     * @param array $server See $_SERVER
     *
     * @return $this;
     */
	public function __construct($get = array(), $post = array(), $files = array(), $server = array())
	{
        $this->get    = $get + $this->get;
        $this->post   = $post + $this->post;
        $this->files  = $files + $this->files;
        $this->server = $server + $this->server;
	}

	public function getRequestedModel()
	{
		return $this->model;
	}

	public function getRequestedModelId()
	{
		if (isset($this->id)) {
			return $this->id;
		}
		return false;
	}

    public function setRequestedModel($model)
    {
        $this->model = $model;
        return $this;
    }

	public function __isset($var)
	{
        if (isset($this->get[$var])
            || isset($this->post[$var])) {
            return true;
        }

        return false;
	}

	public function __get($var)
	{
        if ($var == 'format') {
            $this->determineFormat();
        }
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

    /**
     * Uses the ACCEPT header to fix up the response.
     *
     * @return void
     * @uses   self::$server
     */
    protected function determineFormat()
    {
        if (!isset($this->server['HTTP_ACCEPT'])
            || empty($this->server['HTTP_ACCEPT'])) {
            return;
        }
        $accept = $_SERVER['HTTP_ACCEPT'];
        if (strstr($accept, ';')) {
            $parts = explode(';', $accept); // need a test here
        } else {
            $parts = array($accept);
        }
        $headers = explode(',', $parts[0]); // split headers
        foreach ($headers as $header) {
            if ($header == 'text/html') {
                $this->get['format'] = 'html';
                return;
            }
        }
        //var_dump($parts[0], $accept, $headers); exit;
    }
}
