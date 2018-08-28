<?php
/*---------------------  Nguyenthanhnha.cnttk12@gmail.com ----------------------*/
    include_once 'app/config/DbConfig.php';

    class MyModel extends DbConfig {
        
        // get all works 
        public function findAll($order) {
            if ( !isset($order) ) {
                $order = "id";
            }
            $sql = "SELECT * FROM manage_works ORDER BY $order ASC";
            
            $result = $this->connection->query($sql);
        
            if ($result == false) {
                return false;
            } 
            
            $listWorks = array();
            
            while ($row = $result->fetch_assoc()) {
                $listWorks[] = $row;
            }
            return $listWorks;
        }
        
        // get work by work name
        public function findByNameWork($work_name) {
            
            $sql = "SELECT * FROM manage_works WHERE work_name LIKE '%".$work_name."%'";

            $result = $this->connection->query($sql);
        
            if ($result == false) {
                return false;
            }

            $listWorks = array();
            while ($row = $result->fetch_assoc()) {
                $listWorks[] = $row;
            }
            
            return $listWorks;		
        }

        // get work by id work
        public function findById($id)
        {
            $sql = "SELECT * FROM manage_works WHERE id = '$id'";

            $result = $this->connection->query($sql);

            $work = $result->fetch_assoc();

            return $work;
        }

        // group work follow month and week
        public function findByDateTime($date)
        {
            if ($date == 'month') {
                $sql = "SELECT MONTH(starting_date) as month,YEAR(starting_date) as year,count(id) as total FROM manage_works GROUP BY MONTH(starting_date)"; 
                $result     = $this->connection->query($sql);
                $listWorks  = array();
                while ($row = $result->fetch_assoc()) {
                    $listWorks[] = $row;
                }
                
                return $listWorks;  
            }else if($date = 'week'){
                $sql = "SELECT WEEK(starting_date) as week,YEAR(starting_date) as year,count(id) as total FROM manage_works GROUP BY WEEK(starting_date)"; 
                $result     = $this->connection->query($sql);
                $listWorks  = array();
                while ($row = $result->fetch_assoc()) {
                    $listWorks[] = $row;
                }
                
                return $listWorks; 
            }
        }
        
        // get works with date or week and year or month and year
        public function filterByDateTime($date = null,$month = null,$year = null,$week = null)
        {
            
            if ($date != null) {
                $dbDate = date('Y-m-d H:i:s',strtotime($date));
                $sql = "SELECT * as FROM manage_works WHERE 'starting_date'='$dbDate'"; 
                $result = $this->connection->query($sql);
                $listWorks = array();
                while ($row = $result->fetch_assoc()) {
                    $listWorks[] = $row;
                }
                return $listWorks;  
            }else if ($month != null && $year != null) {
                $sql = "SELECT * FROM manage_works WHERE MONTH(starting_date)='$month' AND YEAR(starting_date) ='$year'"; 
                $result = $this->connection->query($sql);
                $listWorks = array();
                while ($row = $result->fetch_assoc()) {
                    $listWorks[] = $row;
                }
                
                return $listWorks;
            }else if( $week != null && $year != null){
                $sql = "SELECT * FROM manage_works WHERE WEEK(starting_date)='$week' AND YEAR(starting_date) ='$year'"; 

                $result = $this->connection->query($sql);
                $listWorks = array();
                while ($row = $result->fetch_assoc()) {
                    $listWorks[] = $row;
                }
                
                return $listWorks;
            }

        }

        // create works in database 
        public function insert( $work_name, $starting_date, $ending_date, $status ) {

            $dbWorkName = ($work_name != NULL)? $work_name :'NULL';
            $dbStartingDate = date('Y-m-d H:i:s',strtotime($starting_date));
            $dbEndingDate = date('Y-m-d H:i:s',strtotime($ending_date));
            $dbStatus = ($status != NULL)?$status :'NULL';

            $sql = "INSERT INTO manage_works (work_name, starting_date, ending_date, status) VALUES ('$dbWorkName', '$dbStartingDate', '$dbEndingDate', '$dbStatus')";
            
            $result = $this->connection->query($sql);
            return $result;
        }

        // update work in database
        public function edit( $id ,$work_name, $starting_date, $ending_date, $status ) {
            
            $dbWorkName = ($work_name != NULL)? $work_name :'NULL';
            $dbStartingDate = date('Y-m-d H:i:s',strtotime($starting_date));
            $dbEndingDate = date('Y-m-d H:i:s',strtotime($ending_date));
            $dbStatus = ($status != NULL)?$status :'NULL';
            
            $sql = "UPDATE manage_works SET work_name = '$dbWorkName',starting_date = '$dbStartingDate', ending_date = '$dbEndingDate', status ='$dbStatus' WHERE id = $id";
           
            $result = $this->connection->query($sql);
            return $result;
        }
        
        // delete work in database
        public function delete($id) {

            $sql = "DELETE FROM manage_works WHERE id=$id";

            $result = $this->connection->query($sql);
            return $result;
        }
        
    }


?>
