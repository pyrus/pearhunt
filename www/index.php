<?php
require_once __DIR__ . '/../bootstrap.php';

$request = new Request($_GET, $_POST, $_FILES);

$controller = new Controller($request);

$savvy = new PEAR2\Templates\Savant\Main();
$savvy->addTemplatePath(dirname(__FILE__).'/templates/html');

switch ($request->format) {
	case 'json':
		header('Content-type:application/json');
        $savvy->addTemplatePath(dirname(__FILE__).'/templates/'.$request->format);
	    break;
    default:
        header('Content-type:text/html;charset=UTF-8');
}

$savvy->addGlobal('controller', $controller);
$savvy->addGlobal('request', $request);
echo $savvy->render($controller);
