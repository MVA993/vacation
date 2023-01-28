<?php

    class RequestC extends RequestM {

        private $beginDate;
        private $endDate;
        private $position;

        public function __construct($beginDate, $endDate, $position){
            $this->beginDate = $beginDate;
            $this->endDate = $endDate;
            $this->position = $position;

        }

        public function getWorkingDays($beginDate, $endDate){
            $array = array();
        
            $date1 = strtotime($beginDate);
            $date2 = strtotime($endDate);
        
            for ($date = $date1; $date <= $date2; $date +=(86400)){
                $day = date("N",$date);
                if($day < 6){
                    $dbdate = date('Y-m-d',$date);
                    $array[] = $dbdate;
                }
            }
            return $array;
        }

        
    }