{<?php
    $data = $savant->render($context->getModel());
    echo trim($data, ",\n");
?>}
