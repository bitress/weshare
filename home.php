<?php

include_once 'includes/connection.php';

if (isset($_SESSION['isLoggedIn'])){

    $id = $_SESSION['id'];

    $sql = "SELECT * FROM users WHERE user_id = '$id'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
} else {
    header("Location: index.php");
}


if (isset($_POST['post_button'])){

    $user_id = $row['user_id'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql = "INSERT INTO posts (user_id,title, content) VALUES ('$user_id','$title', '$content')";
    $result = mysqli_query($con, $sql);

    if ($result === TRUE){
        header("Location: home.php");
    }
}

if (isset($_POST['like_btn'])){

    $user_id = $_POST['user_id'];
    $post_id = $_POST['post_id'];
    $likes = $_POST['like_value'];

    $likes += 1;

    $sql = "UPDATE posts SET likes = '$likes' WHERE post_id = '$post_id'";
    $result = mysqli_query($con, $sql);
    if ($result === TRUE){
        header("Location: home.php");
    }

}


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home | WeShare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
</head>
<body>

<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
<!--                <li class="nav-item">-->
<!--                    <a class="nav-link" href="#">My Friends</a>-->
<!--                </li>-->
            </ul>
            <div class="d-flex" role="search">
<!--                <a class="btn btn-outline btn-success" href="logout.php">My Profile</a>-->
                <a class="nav-link" href="logout.php">Logout</a>
                </di>
            </div>
        </div>
</nav>


<div class="container px-4 mt-2">

    <div class="row gx-5">
        <div class="col-md-8">

            <!--      Add post          -->
            <div class="card">
                <div class="card-body">
                    <form method="post" action="<?= htmlentities($_SERVER['PHP_SELF']); ?>">
                        <div class="form-group mb-3"></div>
                        <input type="text" name="title" class="form-control" placeholder="Enter your post title">
                        <div class="form-group mb-3">
                            <label>Text (Optional)</label>
                            <textarea class="form-control" name="content" rows="5" placeholder=""></textarea>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" name="post_button" class="btn btn-success">Post</button>
                        </div>
                    </form>
                </div>
            </div>

            <?php

            $sql = "SELECT posts.*, users.username FROM posts LEFT JOIN users ON users.user_id = posts.post_id ORDER BY date_created";
            $result = mysqli_query($con, $sql);
            while ($res = mysqli_fetch_assoc($result)){

            ?>

            <!--Post Card-->
            <div class="animate__animated animate bounce card mt-3">
                <div class="card-body">
                    <h5 class="card-title ms-1"><?php echo (!empty($res['title'])) ? $res['title'] : '' ?></h5>
                    <p class="card-text mb-5 ms-1"><?php echo $res['content'] ?></p>
                    <form method="post" action="home.php">
                            <input type="hidden" name="user_id" value="<?php echo $res['user_id'] ?>">
                            <input type="hidden" name="post_id" value="<?php echo $res['post_id'] ?>">
                            <input type="hidden" name="like_value" value="<?php echo $res['likes'] ?>">
                        <button class="btn btn-light" type="submit" name="like_btn"><?php echo $res['likes'] ?> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg></button>
                    </form>
                </div>
                <div class="card-footer">
                    <h6>Uploaded by <?php echo $res['username'] ?></h6>
                </div>
            </div>

            <?php

            }

            ?>

        </div>

        <div class="col-md-4">

            <div class="card">
                <div class="card-header">
                    <h6>About Me</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <td>Full Name</td>
                                <td><?php echo $row['firstname'] . ' ' .$row['lastname'] ?></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td><?php echo $row['email'] ?></td>
                            </tr>
                            <tr>
                                <td>Username</td>
                                <td><?php echo $row['username'] ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
