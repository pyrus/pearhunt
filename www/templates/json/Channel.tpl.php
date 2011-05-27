<?php
foreach ($context->getPackages() as $package) {
	echo json_encode($package->toArray());
}