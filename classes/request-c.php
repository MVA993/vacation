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

        private function checkVacationDaysLeft(){
            $employee = getEmployee($this->employeeId);
            $position = $employee['position'];
            $oldVacation = $employee['old_vacation'];
            $newVacation = $employee['new_vacation'];

            if ($this->vacationExpiration() == false){
                $totalVacation = $oldVacation + $newVacation;
            }else{
                $totalVacation = $newVacation;
            }

            
        }
        
    }