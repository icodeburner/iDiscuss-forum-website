<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum | iCodeBurner</title>
    <!-- custom css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/fontawesome.min.css"
        integrity="sha384-BY+fdrpOd3gfeRvTSMT+VUZmA728cfF9Z2G42xpaRkUGu2i3DyzpTURDo5A6CaLK" crossorigin="anonymous">
</head>
<style>
    a {
        color: navy;
        text-decoration: none;
    }
    .setImg{
        width: 100%;
        height: 650px;
    }
</style>

<body>

    <?php include 'partials/header.php'; ?>
    <?php include 'db/config.php'; ?>
    <!-- slider -->
    <div id="carouselExampleSlidesOnly" class="carousel slide my-3" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-80 mx-auto setImg" src="https://e0.pxfuel.com/wallpapers/485/990/desktop-wallpaper-blue-dotted-earth-earth-technology.jpg" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="https://img.freepik.com/free-vector/laptop-with-program-code-isometric-icon-software-development-programming-applications-dark-neon_39422-971.jpg?t=st=1718438359~exp=1718441959~hmac=b679419974bcdbabfde1dff87c083c16ee24f8d2f645a56a05222cd2be77cebb&w=1480" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="https://img.freepik.com/free-vector/laptop-with-program-code-isometric-icon-software-development-programming-applications-dark-neon_39422-971.jpg?t=st=1718438359~exp=1718441959~hmac=b679419974bcdbabfde1dff87c083c16ee24f8d2f645a56a05222cd2be77cebb&w=1480" alt="Third slide">
            </div>
        </div>
    </div>
    <div class="container my-3">
        <h2 class="text-center my-3">iDiscuss - Catogries</h2>
        <div class="row">
            <!-- feth all the categories -->
            <?php
            $sql = "SELECT * FROM `categories`";
            $result = mysqli_query($connection, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $cat_id = $row['category_id'];
                $cat_name = $row['category_name'];
                $cat_discription = $row['category_discription'];
                echo '<div class="col-md-4 my-2">
                <div class="card mx-auto" style="width: 18rem;">
                    <img class="card-img-top" src="images/'.$cat_id.'.png" alt="Card image cap" height="200px">
                    <div class="card-body">
                        <h5 class="card-title"><a href="threadslist.php?catid=' . $cat_id . '"> ' . $cat_name . '</a></h5>
                        <p class="card-text">' . substr($cat_discription, 0, 100) . '...</p>
                        <a href="" class="btn btn-primary">View Threads</a>
                    </div>
                </div>
            </div>';
            }
            ?>
        </div>
    </div>

    <?php include 'partials/footer.php'; ?>

    <!-- footer links -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>