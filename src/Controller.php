<?php
class Controller
{
	/**
	 * the request
	 *
	 * @var Request
	 */
	public $request;

	function __construct($request)
	{
		$this->request = $request;
	}

	function getModel()
	{
		$model_name = $this->request->getRequestedModel();
		if ($id = $this->request->getRequestedModelId()) {
			return $model_name::getById($id);
		}
		return new $model_name();
	}
}