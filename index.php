<?php

    include_once 'includes/connection.php';

    if (isset($_POST['login_btn'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE `username` = '$username'";
        $result = mysqli_query($con, $sql);


    }

?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
<section>
    <div class="container">
        <div class="user signinBx">
            <div class="imgBx"><img src="https://raw.githubusercontent.com/WoojinFive/CSS_Playground/master/Responsive%20Login%20and%20Registration%20Form/img1.jpg" alt="" /></div>
            <div class="formBx">
                <form action="index.php" method="post">
                    <h2>Sign In</h2>
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
                <form action="" onsubmit="return false;">
                    <h2>Create an account</h2>
                    <input type="text" name="" placeholder="Username" />
                    <input type="email" name="" placeholder="Email Address" />
                    <input type="password" name="" placeholder="Create Password" />
                    <input type="password" name="" placeholder="Confirm Password" />
                    <input type="submit" name="" value="Sign Up" />
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