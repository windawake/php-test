<?php
// $desc = $_GET['desc'] ? $_GET['desc'] : 'company';
// sleep(6);

// echo "hello " . $desc;

$arrQuery = [
    'checkbox' => [
        'one',
        'two',
        'three',
    ],
];

echo http_build_query($arrQuery);
