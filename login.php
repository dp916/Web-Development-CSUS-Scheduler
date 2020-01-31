<?php include 'authenticate.php'; ?>
<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href= style.css>
<head>
    <title>Advising Login</title>

</head>
<body style="background-color: #F0E1B0 ">


<div style="align-content: center; padding: 10%;">
    <div class="col login-container">
        <div style="text-align: center">
            <img class="logo" src="oie_ALOKQuyhkrpo.png" alt="Sacramento State" width="100%">
        </div>

            <form action="login.php" method="post" >
                <?php require 'error.php'; ?>
                <div class="content-center" style="margin-bottom: 15px">
                    <label for="username">Username</label>
                    <input id="username" class="input-form" type="text" name="username">
                </div>
                <div class="content-center" style="margin-bottom: 15px">
                    <label for="Password">Password</label>
                    <input id="password" class="input-form" type="password" name="password">
                </div>
                <div style="padding-left: 33px">
                    <button type="submit" class="button button1"  name="sign_in">Login</button>
                </div>
            </form>
        <div style="allign-content: center; padding: 10px ">
            <p>
                <strong>Need to Register?</strong><br>
                click <a href="register.php">here</a> to register
            </p>
            <p>
                <strong>Need a SacLink Account?</strong><br>
                Visit
                <a href="https://mysaclink.csus.edu/">SacLink website</a>
                to create an account.
            </p>

        </div>


    </div>
</div>



</body>
</html>
