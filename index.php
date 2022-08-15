<?php
include('controller/RegisterController.php');
include('model/RegistrationForm.php');
session_start();
?>
<html>
<head>
    <title>Register user with OTP in SMS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
<script src="http://code.jquery.com/jquery-1.9.0.js"></script>
<script src="http://code.jquery.com/jquery-migrate-1.2.1.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="bootstrap/js/bootstrap.js"></script>
<div class="container">
    <p class="display-3 text-center">Register user with OTP in SMS</p>
    <form action="controller/RegisterController.php" method="post" id="formRegistration">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control col" placeholder="Enter Email" name="email" id="email" required>
        </div>
        <div class="form-group">
            <label for="phone" class="form-inline">Phone:</label>
            <input type="tel" class="form-control" placeholder="Enter Phone" data-mask="0999 (99-99-99)" name="phone" id="phone"
                   required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" placeholder="Enter Password" name="password" id="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Registration</button>
    </form>
</div>
</body>
</html>