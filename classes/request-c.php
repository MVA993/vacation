<?php

    class RequestC extends RequestM {

        private $beginDate;
        private $endDate;
        private $employeeId;

        public function __construct($beginDate, $endDate, $employeeId){
            $this->beginDate = $beginDate;
            $this->endDate = $endDate;
            $this->employeeId = $employeeId;

        }
        
        public function checkVacation(){

            if($this->checkIfVacationLeft() == false){
                header("location:../index.php?error=novacationleft");
                exit();
            }

            if($this->checkPeriod() == false){
                header("location:../index.php?error=vacationperiodtaken");
                exit();
            }

            $this->insertRequest($this->beginDate, $this->endDate, $this->employeeId);

        }

        public function requestApprove(){
            
        }

        private function getWorkingDays(){
            $array = array();        
            $date1 = strtotime($this->beginDate);
            $date2 = strtotime($this->endDate);
        
            for ($date = $date1; $date <= $date2; $date +=(86400)){
                $day = date("N",$date);
                if($day < 6){
                    $dbdate = date('Y-m-d',$date);
                    $array[] = $dbdate;
                }
            }
            return $array;
        }

        private function vacationExpiration(){
            $month = 'June 30';
            $m = date('m-d',strtotime($month));
            $year = date('Y');
            $full = strtotime($year.'-'.$m);

            $begin = strtotime($this->beginDate);

            if ($full < $begin){
                $result = false;
            }else{
                $result = true;
            }
            return $result;

        }

        private function vacationDays(){
            $employee = $this->getEmployee($this->employeeId);
            $oldVacation = $employee['old_vacation'];
            $newVacation = $employee['new_vacation'];
                
            if ($this->vacationExpiration() == false){
                $total = $oldVacation + $newVacation;
            }else{
                $total = $newVacation;
            }
            return $total;

            }
        
        private function checkIfVacationLeft(){
            $daysReq = $this->getWorkingDays();
            $vacationReq = $this->vacationDays();
            
            if($daysReq > $vacationReq){
                $result = false;
            }else{
                $result = true;
            }
            return $result;

        }

        private function checkPeriod(){
            $employee = $this->getEmployee($this->employeeId);
            $dbinfo = $this->getVacationData($this->beginDate, $this->endDate, $employee['position']);
            
            if(!empty($dbinfo)){
                $result = false;
            }else{
                $result = true;
            }
            return $result;

        }
    }