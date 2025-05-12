<?php
header('Content-Type: application/json; charset=utf-8');

$users = [
    [
        'id' => 1,
        'name' => 'Alice',
        'email' => 'alice@example.com',
        'isActive' => true
    ],
    [
        'id' => 2,
        'name' => 'Bob',
        'email' => 'bob@example.com',
        'isActive' => false
    ],
    [
        'id' => 3,
        'name' => 'Charlie',
        'email' => 'charlie@example.com',
        'isActive' => true
    ]
];


$response = [
    'status' => 'success',
    'timestamp' => time(), 
    'data' => $users       
];

echo json_encode(
    $response
);

exit;
?>
