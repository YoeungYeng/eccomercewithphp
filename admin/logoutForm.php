<?php 
session_start();

session_unset();
session_destroy();

// redirect to login
header("Location: login.php");
