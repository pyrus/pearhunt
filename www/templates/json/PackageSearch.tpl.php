<?php
foreach ($context as $package) {
	echo json_encode($package->toArray());
}