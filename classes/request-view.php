<?php

    class RequestView extends RequestModel {
        private $employeeId;

        public function __construct($employeeId){
            $this->employeeId = $employeeId;
        }

        public function displayRequests(){

            if($this->checkForAdmin() == false){
                header("location:../index.php?error=none");
                exit();
            }

            $rows = $this->getRequestData();

            echo "<table>";

            foreach ($rows as $row)
            {
                if($row['status'] != 'Pending'){
                continue;
                 }

                echo "
                <tr>
                    
                    <td>".$row['employee_name']."</td>
                    <td>".$row['begin_date']."</td>
                    <td>".$row['end_date']."</td>
                    <td>".$row['status']."</td>
                    <form action='/approve.php' method='POST'>
                    <td>
                        <input type='hidden' name='requestId' value=".$row['request_id'].">
                        <input type='radio' id='approve' name='request' value='Approved' checked='checked'/>
                        <label for='approve'>Approve request</label>
                        <input type='radio' id='reject' name='request' value='Rejected'>
                        <label for='reject'>Reject request</label>
                        <button type='submit' name='submit'> Submit </button>
                    </td>
                    </form>
                </tr>
                ";
            }

            echo "</table>";
            }

            private function checkForAdmin(){
                $employee = $this->getEmployee($this->employeeId);
                if($employee['status'] != 'admin'){
                    $result = false;
                }else{
                    $result = true;
                }

                return $result;

            }
    
}