<?php
if(isset($_POST["submit"])){
$begin = $_POST['beginDate'];
$end = $_POST['endDate'];
$employeeId = $loginUsername; //Pretpostavka da sam id zaposlenog izvukao preko imena koje je iskorišćeno za login.

include "../classes/dbconect.php";
include "../classes/request-model.php";
include "../classes/request-controler.php";
include "../classes/request-view.php";

$request = new RequestControler($begin, $end, $employeeId);


$request->checkVacation();

header("location:../index.php?error=none");
}
