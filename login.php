<?php
session_start();
$_SESSION['loggedin'] = true;
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        // $loggedin = false;
        include "db/config.php";

        $user_name = $_POST['user_name'];
        $user_password = $_POST['user_password'];
        $sql = "SELECT * FROM `user_register` WHERE user_name = '$user_name'";
        $result = mysqli_query($connection, $sql);
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                if (password_verify($user_password, $row['user_password'])) {
                    $_SESSION['user_name'] = $user_name;
                    $_SESSION['sno'] = $row['sno'];
                    header("location: index.php");
                }
            }
        }

    }
?>