<?php
    $employeeId = $_POST['employeeId'];
    $beginDate = $_POST['beginDate'];
    $endDate = $_POST['endDate'];
    $requestId = $_POST['requestId'];
    $status = $_POST['status'];

    include "../classes/dbconect.php";
    include "../classes/request-model.php";
    include "../classes/request-controler.php";
    include "../classes/request-view.php";

    $requestReview = new RequestControler($beginDate, $endDate, $employeeId, $requestId, $status);

    $requestReview->requestComplete();