<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum | iCodeBurner</title>
    <!-- custom css -->
    <link rel="stylesheet" href="css/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php 
        include 'partials/header.php'; 
        include 'db/config.php';

        $cat_id = $_GET['catid'];
        $sql = "SELECT * FROM `categories` where category_id = $cat_id";
        $result = mysqli_query($connection, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $category_name = $row['category_name'];
            $category_discription = $row['category_discription'];
        }
    ?>
    <?php
        // $sno = $_SESSION['sno'];
        if ($loggedin) {
            $sno = $_SESSION['sno'];
        }
    $showAlert = false;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($loggedin) {
            $showAlert = true;
            $threads_title = $_POST['threads_title'];
            $threads_discription = $_POST['threads_description'];
            $sql = "INSERT INTO `threads`(`threads_title`, `threads_discription`, `threads_category_id`, `threads_user_id`, `timestamp`) VALUES ('$threads_title','$threads_discription','$cat_id','$sno',CURRENT_TIMESTAMP())";
            $result = mysqli_query($connection, $sql);
        } else {
            echo '<div class="alert alert-danger" role="alert">
            You have to login first.
            </div>';
        }
    }

    // $method = $_SERVER['REQUEST_METHOD'];
    // echo $method;
    ?>
    <div class="container p5">
        <div class="p-5 mb-4 bg-body-tertiary rounded-3 mx-auto my-3">
            <div class="container-fluid py-5">
                <h1 class="display-5 fw-bold">Welcome to <?php echo $category_name; ?> Forums</h1>
                <p class="col-md-8 fs-4"><?php echo $category_discription; ?></p>
                <button class="btn btn-primary btn-lg" type="button">Example button</button>
            </div>
        </div>
    </div>

    <!-- start a discussion form -->
    <div class="container py-3 mb-4 bg-body-tertiary rounded-3 mx-auto p-5">
        <?php
        if ($showAlert == true) {
            echo '<div class="alert alert-success" role="alert">
            Your Query posted, check it out!
            </div>';
        }
        ?>
        <h1 class="py-2 p-2">Start a Discussion</h1>
        <form class="container" method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
            <div class="form-group">
                <label for="exampleInputEmail1">Title</label>
                <input type="text" class="form-control" id="title" name="threads_title">
                <small id="emailHelp" class="form-text text-muted">Keep your title as short and crisp as possible.</small>
            </div>
            <div class="form-group py-3">
                <label for="exampleFormControlTextarea1">Ellaborate Your concern.</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="threads_description"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <div class="container bg-body-tertiary rounded-3 mx-auto">
        <h1>Browse questions</h1>
        <?php
        $cat_id = $_GET['catid'];
        $sql = "SELECT * FROM `threads` where threads_category_id = $cat_id";
        $result = mysqli_query($connection, $sql);
        $noresult = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $noresult = false;
            $threads_title = $row['threads_title'];
            $threads_discription = $row['threads_discription'];
            $timestamp = $row['timestamp'];
            
            $threads_user_id = $row['threads_user_id'];
            $sql2 = "SELECT user_name from `user_register` WHERE sno = '$threads_user_id'";
            $result2 = mysqli_query($connection, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
            $loggedinUserName = $row2['user_name'];

            echo '<div class="media p-5">
            <div class="media-body d-flex">
            <img class="mr-3" src="images/user_default_image.jpg" alt="Generic placeholder image" width="30px">
            <p>' . $loggedinUserName . ' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small>' . $timestamp . ' </small></p>
            </div>
            <h5 class="mt-0"><a href="thread.php?threadid=' . $cat_id . '"> ' . $threads_title . '</a></h5>
            ' . $threads_discription . '
        </div>
        ';
        }
        if ($noresult) {
            echo '<div class="container">
                <div class="p-5 mb-4 bg-body-tertiary rounded-3 mx-auto my-3">
                    <div class="container-fluid py-5">
                        <p class="display-5 fw-light"> No Threads Found</p>
                        <p><b>Be the first person to ask questions</b></p>
                    </div>
                </div>
            </div>
            ';
        }
        ?>
    </div>

    <?php include 'partials/footer.php'; ?>

    <!-- footer links -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>