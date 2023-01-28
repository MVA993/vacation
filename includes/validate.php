<?php
if(isset($_POST["submit"])){
$begin = $_POST['beginDate'];
$end = $_POST['endDate'];
$employee = $_SESSION['login_username'];

include "../classes/dbconect.php";
include "../classes/request-m.php";
include "../classes/request-c.php";
include "../classes/request-m.php";

$request = new RequestC($begin, $end, $employee);
$request->checkVacation();
}

header("location:../index.php?error=none");

