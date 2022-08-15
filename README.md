# OTP
OTP verification using an SMS message

## Requirements:
- PHP 8.1
- PHPUnit 9

## Getting started:
1. Install xampp (or other server)
2. Copy the project and load it locally
3. Install vendor to make requst to Twilio make in terminal composer install
4. Open in browser http://localhost/phpmyadmin/index.php?route=/database/sql&db=mysql and add this sql  
   CREATE DATABASE `otp`;
   CREATE TABLE IF NOT EXISTS `users` (
   `id` int(11) NOT NULL AUTO_INCREMENT,
   `email` varchar(255) NOT NULL,
   `password` varchar(255) NOT NULL,
   `phone` varchar(13) NOT NULL,
   `date_create` DATETIME NOT NULL DEFAULT NOW(),
   PRIMARY KEY (`id`)
   );
   CREATE TABLE IF NOT EXISTS `app_request_log` (
   `id` int(11) NOT NULL AUTO_INCREMENT,
   `date_create` DATETIME NOT NULL DEFAULT NOW(),
   `data_input` varchar(6),
   `verificated` boolean NOT NULL DEFAULT 0,
   `phone` varchar(13) NOT NULL,
   PRIMARY KEY (`id`)
   );
   CREATE TABLE IF NOT EXISTS `twilio_response` (
   `id` int(11) NOT NULL AUTO_INCREMENT,
   `code` varchar(6) NOT NULL,
   `phone` varchar(13) NOT NULL,
   `response` varchar(255) NOT NULL,
   `date_create` DATETIME NOT NULL DEFAULT NOW(),
   PRIMARY KEY (`id`)
   );
5. and press button go  and now you have database
6. Open in browser http://localhost/otp
7. Create registration

## Testing:
```$ ./vendor/bin/phpunit tests```