<?php
    $Overview->add('/view/:action', [
        'controller' => 'view',
        'action' => 1
    ]);

    $Overview->add('/details/{uuid}', [
        'controller' => 'details',
        'action' => 'index'
    ]);

    $Overview->add('/submit', [
        'controller' => 'import',
        'action' => 'index'
    ]);
?>