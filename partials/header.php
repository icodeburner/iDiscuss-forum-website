<?php

session_start();
$loggedin = isset($_SESSION['loggedin']);
?>
<div class="container">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">iDiscuss</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Catogries</a>
                        <ul class="dropdown-menu">
                            <?php
                            include "db/config.php";
                            $sql = "SELECT * FROM categories LIMIT 3";
                            $result = mysqli_query($connection, $sql);
                            while ($row = mysqli_fetch_assoc($result)) {
                                $category_id = $row['category_id'];
                                $category_name = $row['category_name'];
                                echo '<li>
                                <a href="threadslist.php?catid=' . $category_id . '"> ' . $category_name . '</a>
                            </li>';
                            }
                            ?>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
                <form class="d-flex me-3" role="search" method="get" action="search.php">
                    <input type="search" class="form-control me-2" placeholder="Search" name="search">
                </form>
                <!-- Login Modal -->
                <?php
                if (!$loggedin) : ?>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal">
                        Login
                    <?php endif; ?>
                    </button>
                    <div class="modal fade" id="loginModal" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5">Welcome Back!</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="login.php" method="post">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="emailFormControlInput" class="form-label">Name</label>
                                            <input type="text" name="user_name" class="form-control" placeholder="Name" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="passwordFormControlInput" class="form-label">Password</label>
                                            <input type="password" name="user_password" class="form-control" id="passwordFormControlInput" placeholder="Password" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" name="login-btn" class="btn btn-primary">Login</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Register Modal -->
                    <?php
                    if (!$loggedin) : ?>

                        <button type="button" class="btn btn-primary ms-3" data-bs-toggle="modal" data-bs-target="#registerModal">
                            Register
                        <?php endif ?>
                        </button>
                        <div class="modal fade" id="registerModal" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5">Create Account</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="submit-register-data.php" method="post">
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="nameFormControlInput" class="form-label">Name</label>
                                                <input type="text" name="user_name" class="form-control" id="nameFormControlInput" placeholder="Name" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="phoneFormControlInput" class="form-label">Phone Number</label>
                                                <input type="text" name="user_mobile" class="form-control" id="phoneFormControlInput" placeholder="Phone Number" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="emailFormControlInput" class="form-label">Email</label>
                                                <input type="email" name="user_email" class="form-control" id="emailFormControlInput" placeholder="Email" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="passwordFormControlInput" class="form-label">Password</label>
                                                <input type="password" name="user_password" class="form-control" id="passwordFormControlInput" placeholder="Password" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" name="register-btn" class="btn btn-primary">Register</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown ms-3">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?php if (isset($_SESSION['loggedin'])) {
                                                                                                                                            echo "hello, " . $_SESSION['user_name'];
                                                                                                                                        } else {
                                                                                                                                            echo "heyy,";
                                                                                                                                        }                                                                                                                                ?>

                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <?php if ($loggedin) : ?>
                                        <a class="dropdown-item" href="profile.php">Profile</a>
                                    <?php endif; ?>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="settings.php">Settings</a>
                                </li>
                                <li>
                                    <?php
                                    if ($loggedin) : ?>
                                        <a class="dropdown-item" href="logout.php">Logout</a>
                                    <?php endif; ?>
                                </li>
                            </ul>
                        </div>
            </div>
        </div>
    </nav>
</div>