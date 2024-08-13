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
    <?php include 'partials/header.php'; ?>
    <?php include 'db/config.php'; ?>
    <?php
    $id = $_GET['threadid'];
    $sql = "SELECT * FROM `threads` where threads_category_id = $id";
    $result = mysqli_query($connection, $sql);
    $noresult = true;
    while ($row = mysqli_fetch_assoc($result)) {
        $threads_title = $row['threads_title'];
        $threads_discription = $row['threads_discription'];
    }
    ?>

    <div class="container p5">
        <div class="p-5 mb-4 bg-body-tertiary rounded-3 mx-auto my-3">
            <div class="container-fluid py-5">
                <h1 class="display-5 fw-light"><?php echo $threads_title; ?></h1>
                <p class="col-md-8 fs-4"><?php echo $threads_discription; ?></p>
                <!-- <p><b>Posted by: Ansh</b></p> -->
            </div>
        </div>
    </div>

    <?php
    // $sno = $_SESSION['sno'];
    if ($loggedin) {
        $sno = $_SESSION['sno'];
    }
    $showAlert = false;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($loggedin) {
            $comment_content = $_POST['comment'];
            $sql = "INSERT INTO `comments`(`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$comment_content','$id','$sno',CURRENT_TIMESTAMP())";
            $result = mysqli_query($connection, $sql);
            $showAlert = true;
        } else {
            echo '<div class="alert alert-danger" role="alert">
            You have to login first.
            </div>';
        }
    }

    // $method = $_SERVER['REQUEST_METHOD'];
    // echo $method;
    ?>
    <div class="container py-3 mb-4 bg-body-tertiary rounded-3 mx-auto p-5">
        <?php
        if ($showAlert == true) {
            echo '<div class="alert alert-success" role="alert">
            Your Query posted, check it out!
            </div>';
        }
        ?>
        <h1 class="py-2 p-2">Post a comment</h1>
        <form class="container" method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
            <div class="form-group py-3">
                <label for="exampleFormControlTextarea1">Type your comment</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="comment"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <div class="container">
        <h1>Discussion</h1>
        <?php
        $cat_id = $_GET['threadid'];
        $sql = "SELECT * FROM `comments` where thread_id = $cat_id";
        $result = mysqli_query($connection, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $comment_id = $row['comment_id'];
            $comment_content = $row['comment_content'];
            $comment_time = $row['comment_time'];

            $comment_by = $row['comment_by'];
            $sql2 = "SELECT user_name from `user_register` WHERE sno = '$comment_by'";
            $result2 = mysqli_query($connection, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
            $loggedinUserName = $row2['user_name'];

            echo '<div class="media my-5">
            <div class="media-body d-flex">
            <img class="mr-3" src="images/user_default_image.jpg" alt="Generic placeholder image" width="30px">
             <p><b>'.$loggedinUserName.' </b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small>' . $comment_time . ' </small></p>
             </div>
             <p>' . $comment_content . '</p>
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