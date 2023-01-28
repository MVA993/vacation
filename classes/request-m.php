<?php

class RequestM extends Db {

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

        return $result;
        
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
        $sql = "SELECT employee_name, begin_date, end_date, status  
                FROM requests
                INNER JOIN employees
                ON requests.employee_id = employees.employee_id
                WHERE status = 'Pending approval';";

        $result = $conn->query($sql);

        return $result;
    }

    protected function approveRequest($status){
        $sql = "UPDATE requests"
    }

}