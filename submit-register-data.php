<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "db/config.php";

    $user_name = $_POST['user_name'];
    $user_mobile = $_POST['user_mobile'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $user_password = password_hash($user_password, PASSWORD_DEFAULT);

    $register_data = "INSERT INTO `user_register` (`user_name`, `user_mobile`, `user_email`, `user_password`) VALUES ('$user_name', '$user_mobile', '$user_email', '$user_password')";

    $result = mysqli_query($connection, $register_data);
    if ($result) {
        header("location: index.php");
    } else {
        echo "w";
    }
}
