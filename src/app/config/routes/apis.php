<?php
    $APIs->add('/api', [
        'controller' => 'api',
        'action' => 'index'
    ]);

    $APIs->add('/api/category/{category}', [
        'controller' => 'api',
        'action' => 'category'
    ]);

    $APIs->add('/api/head/{uuid}', [
        'controller' => 'api',
        'action' => 'head'
    ]);
?>