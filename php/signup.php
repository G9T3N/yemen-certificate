<?php

include "../connect.php";

$F_name = filterRequest('F_name');
$L_name = filterRequest('L_name');
$Phone = filterRequest('Phone');
$password = filterRequest('password');
$password=Md5($password);
$Email = filterRequest('Email');

$stmt = $c->prepare(
    "SELECT * FROM users WHERE Email=:Email OR Phone=:Phone"
);
$stmt->bindParam('Phone', $Phone);
$stmt->bindParam('Email', $Email);

$stmt->execute();

$count = $stmt->rowCount();

if ($count > 0) {
    print("email of phone already exist");
} else {
    $data =array(
        'F_name' => $F_name,
        'L_name' => $L_name,
        'Phone' => $Phone,
        'password' => $password,
        'Email' => $Email,
    );
    insertData("users", $data);
}
