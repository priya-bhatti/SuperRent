<?php class Vehicle{
            private $db;

            public function __construct(){
                $this->db = new Database;
            }

            //gets
            //------------------------------------------------------------------------------

            // CARTYPE
            public function getVType($type){
                $this->db->query("SELECT vtname, COUNT(vid) as available 
                FROM Vehicle
                WHERE vtname = :type 
                GROUP BY vtname");

                $this->db->bind(':type', $type);

                $results = $this->db->resultSet();
                return $results;
            }

            // LOCATION
            // public function getVTypesByLoc($loc, $city){
            //     $this->db->query("SELECT *
            //     FROM VehicleType");
            //     $results = $this->db->resultSet();
            //     return $results;
            // }

            // TIME INTERVAL
            // public function getVTypesByTime($fd, $ft, $td, $tt){
            //     $this->db->query("SELECT *
            //     FROM VehicleType");
            //     $results = $this->db->resultSet();
            //     return $results;
            // }

            // CARTYPE + LOCATION
            // public function getVTypeByTypeLoc($type, $loc, $city){
            //     $this->db->query("SELECT *
            //     FROM VehicleType");
            //     $results = $this->db->resultSet();
            //     return $results;
            // }

            // CARTYPE + INTERVAL
            // public function getVTypeByTypeTime($type, $fd, $ft, $td, $tt){
            //     $this->db->query("SELECT *
            //     FROM VehicleType");
            //     $results = $this->db->resultSet();
            //     return $results;
            // }

            // LOCATION + TIME
            // public function getVTypesLocTime($loc, $city, $fd, $ft, $td, $tt)){
            //     $this->db->query("SELECT *
            //     FROM VehicleType");
            //     $results = $this->db->resultSet();
            //     return $results;
            // }
            

            // CARTYPE + LOCATION + TIME
            // public function getVTypeByTypeLocTime($type, $loc, $city, $fd, $ft, $td, $tt){
            //     $this->db->query("SELECT *
            //     FROM VehicleType");
            //     $results = $this->db->resultSet();
            //     return $results;
            // }

            //get location info
            public function getBranches(){
                $this->db->query("SELECT * FROM Branch");
                $results = $this->db->resultSet();
                return $results;
            }

            //
            // public function getVehicle($id){
            //     $this->db->query("SELECT * FROM Vehicle
            //     WHERE vid = :id");

            //     $this->db->bind(':id', $id);

            //     //assign row
            //     $row = $this->db->single();

            //     return $row;
            // }

            //get vehicletypes
            public function getTypes(){
                $this->db->query("SELECT * from VehicleType");
                $results = $this->db->resultSet();
                return $results;
            }

            public function getVehicleDetail($type) {
                $this->db->query("SELECT * FROM VehicleType
                WHERE vtname = :type");

                $this->db->bind(':type', $type);

                //assign single row
                $row = $this->db->single();
                return $row;
            }

            public function getAllVehicles($type) {
                $this->db->query("SELECT * FROM Vehicle
                WHERE vtname = :type");

                $this->db->bind(':type', $type);

                //assign single row
                $results = $this->db->resultSet();
                return $results;
            }


            //------------------------------------------------------------------------------

            // posts
            //create vehicle
            // public function create($data){
            //     $this->db->query("INSERT INTO vehicles (category_id,
            //     vehicle_title,
            //     company,
            //     description,
            //     location,
            //     salary,
            //     contact_user)
            //     VALUES(:category_id, :vehicle_title, :company, :description, :location, :salary, :contact_user)");

            //     //bind data
            //     $this->db->bind(':category_id', $data['category_id']);
            //     $this->db->bind(':vehicle_title', $data['vehicle_title']);
            //     $this->db->bind(':company', $data['company']);
            //     $this->db->bind(':description', $data['description']);
            //     $this->db->bind(':location', $data['location']);
            //     $this->db->bind(':salary', $data['salary']);
            //     $this->db->bind(':contact_user', $data['contact_user']);

            //     //execute
            //     if($this->db->execute()){
            //         return true;
            //     } else {
            //         return false;
            //     }

            // }

            // //delete vehicle
            // public function delete($id){
            //     $this->db->query("DELETE FROM vehicles WHERE id = $id");
            
            //     //execute
            //     if($this->db->execute()){
            //         return true;
            //     } else {
            //         return false;
            //     }
            // }

            //update vehicle
            // public function update($id, $data){
            //     $this->db->query("UPDATE vehicles SET 
            //     category_id = :category_id,
            //     vehicle_title = :vehicle_title,
            //     company = :company,
            //     description = :description,
            //     location = :location,
            //     salary = :salary,
            //     contact_user = :contact_user
            //     WHERE id = $id");

            //     //bind data
            //     $this->db->bind(':category_id', $data['category_id']);
            //     $this->db->bind(':vehicle_title', $data['vehicle_title']);
            //     $this->db->bind(':company', $data['company']);
            //     $this->db->bind(':description', $data['description']);
            //     $this->db->bind(':location', $data['location']);
            //     $this->db->bind(':salary', $data['salary']);
            //     $this->db->bind(':contact_user', $data['contact_user']);

            //     //execute
            //     if($this->db->execute()){
            //         return true;
            //     } else {
            //         return false;
            //     }

            // }
        }