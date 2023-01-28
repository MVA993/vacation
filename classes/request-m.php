<?php

class RequestM extends Db {

    protected function getEmployee($employeeId) {
        $sql = "SELECT * 
                FROM employees
                WHERE employee_id = '$employeeId';";
        
        $result = $conn->query($sql);
        $row = $result->mysqli_fetch_assoc();
        return $row;
    }

    protected function getVacationData($beginDate, $endDate, $position){
        $sql = "SELECT * 
                FROM requests 
                INNER JOIN employees 
                ON requests.employee_id = employees.employee_id
                INNER JOIN vacation 
                ON requests.employee_id = vacation.employee_id
                WHERE vacation_date BETWEEN '$beginDate' AND '$endDate' 
                AND '$position' = position;";

        $result = $conn->query($sql);
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        return $rows;
        
    }   

    protected function insertRequest($beginDate, $endDate, $employeeId) {
        $sql = "INSERT INTO requests (request_id, employee_id, begin_date, end_date, status)
                VALUES ('','$employeeId', '$beginDate', '$endDate', 'Pending approval');";
        
        if(!$conn->query($sql) === TRUE ){
            header("location: profile.php?error=insertfailed");
            exit();
        }
    }

    protected function getRequestData (){
        $sql = "SELECT *  
                FROM requests
                INNER JOIN employees
                ON requests.employee_id = employees.employee_id
                WHERE status = 'Pending approval';";

        $result = $conn->query($sql);
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        return $rows;
    }

    protected function requestStatusChange($status, $requestId){
        $sql = "UPDATE requests
                SET status = $status
                WHERE request_id = '$requestId';";

        if(!$conn->query($sql) === TRUE ){
            header("location: profile.php?error=statuschangefailed");
            exit();
            }
    }

    protected function insertVacationDays($employeeId, $vacationDates) {
        foreach ($vacationDates as $day){
            $sql = "INSERT INTO vacation (employee_id, vacation_date)
                VALUES ('$employeeId','$day');";
        }              
        
        if(!$conn->query($sql) === TRUE ){
            header("location: profile.php?error=insertfailed");
            exit();
        }
    }
    
}