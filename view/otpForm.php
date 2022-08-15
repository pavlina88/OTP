<?php
include('../controller/OTPController.php');
session_start();
?>
<html>
<head>
    <title>OTP Code</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
</head>
<body>
<script src="http://code.jquery.com/jquery-1.9.0.js"></script>
<script src="http://code.jquery.com/jquery-migrate-1.2.1.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../bootstrap/js/bootstrap.js"></script>
<body>
<div class="container">
    <p class="display-3 text-center">Register user with OTP in SMS</p>
    <form action="../controller/OTPController.php" method="post" id="formRegistration">
        <div class="form-group">
            <label for="code">OTP Code:</label>
            <input type="input" class="form-control col" placeholder="Enter OTP Code" name="code" id="code" data-mask="999999" required>
        </div>
        <button type="submit" class="btn btn-primary" ">Registration</button>
    </form>
</div>
</body>
</html>