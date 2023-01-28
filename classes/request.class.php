<?php

class Request extends Db {

    protected function checkVacation($beginDate, $endDate, $position){
        $stmt = $this->connect()->prepare('SELECT begin_date, end_date, position 
                    FROM requests 
                    INNER JOIN employees 
                    ON requests.employee_id = employees.employee_id
                    WHERE ( ? <= end_date OR ? => begin_date ) 
                    AND ? = position;');

        if(!$stmt->execute(array($beginDate, $endDate, $position))){
            $stmt = null;
            header ("location:../index.php?error=stmtfailed");
            exit()
        }

        $result;
        if($stmt->rowCount()>0){
            $result = false;
        }else{
            $result= true;
        }
        return $result;
    }
}