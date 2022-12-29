<?php

    include_once 'includes/connection.php';

    if (isset($_POST['login_btn'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM users WHERE `username` = '$username'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);
        if (mysqli_num_rows($result) > 0){
            if ($row['password'] == $password){
                $_SESSION['isLoggedIn'] = true;
                $_SESSION['id'] = $row['user_id'];
                header("Location: home.php");
            } else {
                echo "Incorrect password";
            }
        } else {
            echo "No user found";
        }
    }

    if (isset($_POST['register_btn'])){

        $firstname = $_POST['fname'];
        $lastname = $_POST['lname'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "INSERT INTO `users` (firstname, lastname, email, username, password) VALUES ('$firstname', '$lastname', '$email', '$username', '$password')";
        $result = mysqli_query($con, $sql);

        if ($result === TRUE){
            echo "Register successful! You may now login";
        }

    }

?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login | WeShare</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
<section>
    <div class="container">
        <div class="user signinBx">
            <div class="imgBx"><img src="https://raw.githubusercontent.com/WoojinFive/CSS_Playground/master/Responsive%20Login%20and%20Registration%20Form/img1.jpg" alt="" /></div>
            <div class="formBx">
                <form action="index.php" method="post">
                    <h2>Sign In to WeShare</h2>
                    <input type="text" name="username" placeholder="Username" />
                    <input type="password" name="password" placeholder="Password" />
                    <input type="submit" name="login_btn" value="Login" />
                    <p class="signup">
                        Don't have an account ?
                        <a href="#" onclick="toggleForm();">Sign Up.</a>
                    </p>
                </form>
            </div>
        </div>
        <div class="user signupBx">
            <div class="formBx">
                <form action="index.php" method="post">
                    <h2>Create an account</h2>
                    <input type="text" name="fname" placeholder="First Name" />
                    <input type="text" name="lname" placeholder="Last Name" />
                    <input type="text" name="uname" placeholder="Username" />
                    <input type="email" name="email" placeholder="Email Address" />
                    <input type="text" name="password" placeholder="Create Password" />
                    <input type="submit" name="register_btn" value="Sign Up" />
                    <p class="signup">
                        Already have an account ?
                        <a href="#" onclick="toggleForm();">Sign in.</a>
                    </p>
                </form>
            </div>
            <div class="imgBx"><img src="https://raw.githubusercontent.com/WoojinFive/CSS_Playground/master/Responsive%20Login%20and%20Registration%20Form/img2.jpg" alt="" /></div>
        </div>
    </div>
</section>
<script>
    const toggleForm = () => {
        const container = document.querySelector('.container');
        container.classList.toggle('active');
    };
</script>
</body>
</html>