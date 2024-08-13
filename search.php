<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum | iCodeBurner</title>
    <!-- custom css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<style>
    a {
        color: navy;
        text-decoration: none;
    }
</style>

<body>

    <?php include 'partials/header.php'; ?>
    <?php include 'db/config.php'; ?>

    <!-- enable fulltext search in phpmyadmin SQL -->
    <!-- select * from threads where match (threads_title, threads_discription) against ('tell'); -->
    <div class="container p5">
        <div class="p-5 mb-4 bg-body-tertiary rounded-3 mx-auto my-3">
            <div class="container-fluid py-5">
                <h1 class="display-5 fw-bold">search results for " <em><?php echo $_GET['search']; ?> "</em></h1>
                <?php
                $searchResult = $_GET['search'];
                $sql = "SELECT * from threads where match (threads_title, threads_discription) against ('$searchResult')";
                $result = mysqli_query($connection, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    $threads_title = $row['threads_title'];
                    $threads_id = $row['threads_id'];
                    $threads_discription = $row['threads_discription'];

                    echo '<div class="result py-5">
                    <h3><a href="thread.php?threadid='.$threads_id.'" class="text-dark">'.$threads_title.'</a></h3>
                    <h4><a href="" class="text-dark">'.$threads_discription.'</a></h4>
                </div>';
                }
                ?>
            </div>
        </div>
    </div>

    <?php include 'partials/footer.php'; ?>

    <!-- footer links -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>