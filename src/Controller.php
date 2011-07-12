<?php
class Controller
{
	/**
	 * the request
	 *
	 * @var Request
	 */
	public $request;

    /**
     * __construct
     *
     * @param Request $request
     *
     * @return $this
     */
	function __construct(Request $request)
	{
		$this->request = $request;
	}

	function getModel()
	{
		$model_name = $this->request->getRequestedModel();
		if ($id = $this->request->getRequestedModelId()) {
			return $model_name::getById($id);
		}
		return new $model_name($this->request->getOptions());
	}
}
