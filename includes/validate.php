<?php
if(isset($_POST["submit"])){
$begin = $_POST['beginDate'];
$end = $_POST['endDate'];
$employeeId = $loginUsername; //pretpostavka da sam id zaposlenog izvukao preko imena koje je iskorišćeno za login

include "../classes/dbconnect.php";
include "../classes/request-m.php";
include "../classes/request-c.php";
include "../classes/request-m.php";

$request = new RequestC($begin, $end, $employeeId);
}

$request->checkVacation();

header("location:../index.php?error=none");

