<?php class Vehicle{
            private $db;

            public function __construct(){
                $this->db = new Database;
            }

            //gets
            //------------------------------------------------------------------------------
            
            // No Search Fields
            public function getAll(){
                $this->db->query("SELECT vtname, COUNT(vtname) as available 
                FROM Vehicle WHERE status='available'
                GROUP BY vtname");

                $results = $this->db->resultSet();
                return $results;
            }

            // CARTYPE
            public function getVType($type){
                $this->db->query("SELECT vtname, COUNT(vtname) as available 
                FROM Vehicle
                WHERE vtname = :type AND status='available'
                GROUP BY vtname");

                $this->db->bind(':type', $type);

                $results = $this->db->resultSet();
                return $results;
            }

            // LOCATION
            public function getVTypesByLoc($loc, $city){
                $this->db->query("SELECT vtname, COUNT(vtname) as available
                FROM Vehicle 
                WHERE location = :loc AND city = :city AND status='available'
                GROUP BY vtname");
                
                $this->db->bind(':loc', $loc);
                $this->db->bind(':city', $city);

                $results = $this->db->resultSet();
                return $results;
            }

            // TIME INTERVAL (just return all with available status)
            public function getVTypesByTime($fd, $ft, $td, $tt){
                $this->db->query("SELECT vtname, COUNT(vtname) as available 
                FROM Vehicle WHERE status='available'
                GROUP BY vtname");

                $results = $this->db->resultSet();
                return $results;
            }

            // CARTYPE + LOCATION 
            public function getVTypeByTypeLoc($type, $loc, $city){
                $this->db->query("SELECT vtname, COUNT(vtname) as available
                FROM Vehicle 
                WHERE vtname = :type AND location = :loc AND city = :city AND status='available'
                GROUP BY vtname");

                $this->db->bind(':loc', $loc);
                $this->db->bind(':city', $city);
                $this->db->bind(':type', $type);

                $results = $this->db->resultSet();
                return $results;
            }

            // CARTYPE + INTERVAL (just return type)
            public function getVTypeByTypeTime($type, $fd, $ft, $td, $tt){
                $this->db->query("SELECT vtname, COUNT(vtname) as available 
                FROM Vehicle
                WHERE vtname = :type AND status='available'
                GROUP BY vtname");

                $this->db->bind(':type', $type);

                $results = $this->db->resultSet();
                return $results;
            }

            // LOCATION + TIME (just return location)
            public function getVTypesLocTime($loc, $city, $fd, $ft, $td, $tt){
                $this->db->query("SELECT vtname, COUNT(vtname) as available
                FROM Vehicle 
                WHERE location = :loc AND city = :city AND status='available'
                GROUP BY vtname");
                
                $this->db->bind(':loc', $loc);
                $this->db->bind(':city', $city);

                $results = $this->db->resultSet();
                return $results;
            }
            

            // CARTYPE + LOCATION + TIME (cartype and location)
            public function getVTypeByTypeLocTime($type, $loc, $city, $fd, $ft, $td, $tt){
                $this->db->query("SELECT vtname, COUNT(vtname) as available
                FROM Vehicle 
                WHERE vtname = :type AND location = :loc AND city = :city AND status='available'
                GROUP BY vtname");

                $this->db->bind(':loc', $loc);
                $this->db->bind(':city', $city);
                $this->db->bind(':type', $type);

                $results = $this->db->resultSet();
                return $results;
            }

            //get location info
            public function getBranches(){
                $this->db->query("SELECT * FROM Branch");
                $results = $this->db->resultSet();
                return $results;
            }

            //get branches to delete
            public function getDelBranches(){
                $this->db->query("select b.location, b.city from Branch b where (location, city) NOT IN(select location, city from vehicle)");
                $results = $this->db->resultSet();
                return $results;
            }

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


            //get vehicletypes that can be deleted
            public function getDelTypes(){
                $this->db->query("SELECT vtname from VehicleType where vtname NOT IN(select v.vtname from Vehicle v)");
                $results = $this->db->resultSet();
                return $results;
            }

            public function getAllVehicles($type) {
                $this->db->query("SELECT * FROM Vehicle
                WHERE vtname = :type");

                $this->db->bind(':type', $type);

                //assign single row
                $results = $this->db->resultSet();
                return $results;
            }

            // get vehicle types available for rental
            public function getVtypesDropDown() {
                $this->db->query("SELECT DISTINCT vtname FROM Vehicle
                WHERE status = 'available'");

                //assign single row
                $results = $this->db->resultSet();
                return $results;
            }
                        
            // get vehicles that can be deleted
            public function getDelVehicles() {
                $this->db->query("SELECT vlicense FROM Vehicle
                WHERE vlicense NOT IN(select vlicense from Rent)");

                $results = $this->db->resultSet();
                return $results;
            }

            //CUSTOMER 
            public function getCustomer($dlicense){
                $this->db->query("SELECT * FROM Customer
                WHERE dlicense = :dlicense");

                $this->db->bind(':dlicense', $dlicense);
                $results = $this->db->resultSet();
                return $results;
            }

            //RESERVATION w/o confNo
            public function getReservation($vtname, $dlicense, $fromdate, $fromtime, $todate, $totime) {
                $this->db->query("SELECT * FROM Reservation
                WHERE vtname = :vtname AND
                dlicense = :dlicense AND
                fromdate = :fromdate AND
                fromtime = :fromtime AND
                todate = :todate AND
                totime = :totime");

                $this->db->bind(':vtname', $vtname);
                $this->db->bind(':dlicense', $dlicense);
                $this->db->bind(':fromdate', $fromdate);
                $this->db->bind(':fromtime', $fromtime);
                $this->db->bind(':todate', $todate);
                $this->db->bind(':totime', $totime);

                //assign single row
                $row = $this->db->single();
                return $row;
            }

            //get reservation with only phone number
            public function getReservationLicense($dlicense) {
                $this->db->query("SELECT * FROM Reservation
                WHERE dlicense = :dlicense");
                $this->db->bind(':dlicense', $dlicense);
                //assign single row
                $row = $this->db->single();
                return $row;
            }

            //get reservation with confno
            public function getSingleReservation($confno) {
                $this->db->query("SELECT * FROM Reservation
                WHERE confno = :confno");
                $this->db->bind(':confno', $confno);
                //assign single row
                $row = $this->db->single();
                return $row;
            }

            //get rental confirmation
            public function getRentalConf($confno) {
                $this->db->query("SELECT * FROM Rent
                WHERE confno = :confno");
                $this->db->bind(':confno', $confno);
                //assign single row
                $row = $this->db->single();
                return $row;
            }

            //get rental confirmation w/o reservation
            public function getRentalConfRes($dlicense, $fromdate, $todate) {
                $this->db->query("SELECT * FROM Rent
                WHERE dlicense = :dlicense and fromdate = :fromdate and todate = :todate");
                $this->db->bind(':dlicense', $dlicense);
                $this->db->bind(':fromdate', $fromdate);
                $this->db->bind(':todate', $todate);
                //assign single row
                $row = $this->db->single();
                return $row;
            }

            //get return confirmation
            public function getReturnConf($rid) {
                $this->db->query("SELECT DISTINCT r.confNO, 
                rn.dater as return_date, rn.timer as retunr_time,
                FLOOR( (DATE(rn.dater) - DATE(r.fromDate))/7) as Winterval, vt.wrate as weekRate, vt.wirate as WeekInsur,
                (DATE(rn.dater) - DATE(r.fromDate)) - (FLOOR((DATE(rn.dater) - DATE(r.fromDate))/7)*7) as Dinterval, 
                vt.drate as dayRate, vt.dirate as DayInsur,
                rn.odometer - r.odometer as odoDiff, vt.krate as odoRate, 
                (FLOOR((DATE(rn.dater) - DATE(r.fromDate))/7) * (vt.wrate + vt.wirate) ) + 
                (((DATE(rn.dater) - DATE(r.fromDate)) - (FLOOR((DATE(rn.dater) - DATE(r.fromDate))/7)*7) )* (vt.drate + vt.dirate)) + 
                ((rn.odometer - r.odometer)* vt.krate)as TOTAL
                FROM ReturnV rn, Rent r, Vehicle v, VehicleType vt
                WHERE rn.rid = r.rid AND v.vtname = vt.vtname AND v.vlicense= r.vlicense
                AND rn.rid = :rid");
                
                $this->db->bind(':rid', $rid);
                //assign single row
                $row = $this->db->single();
                return $row;
            }

            //get reservations
            public function getAllReservations(){
                $this->db->query("SELECT * from Reservation");
                $results = $this->db->resultSet();
                return $results;
            }

            //get reservations that can be deleted
            public function getDelReservations(){
                $this->db->query("SELECT confno from Reservation 
                Where confno NOT IN(select r.confno from Rent r)");
                $results = $this->db->resultSet();
                return $results;
            }

            //get rentals
            public function getAllRentals(){
                $this->db->query("SELECT * from Rent");
                $results = $this->db->resultSet();
                return $results;
            }

            //get rentals that are not yet returned
            public function getRentalsDropdown(){
                $this->db->query("SELECT DISTINCT r.rid from Rent r, Vehicle v WHERE r.vlicense = v.vlicense AND v.status = 'rented'");
                $results = $this->db->resultSet();
                return $results;
            }

            //get rentals that can be deleted
            public function getDelRentals(){
                $this->db->query("SELECT rid from Rent 
                Where rid NOT IN(select r.rid::int from ReturnV r)");
                $results = $this->db->resultSet();
                return $results;
            }

            //get returns
            public function getAllReturns(){
                $this->db->query("SELECT * from ReturnV");
                $results = $this->db->resultSet();
                return $results;
            }

            //get customers
            public function getAllCustomers(){
                $this->db->query("SELECT * from Customer");
                $results = $this->db->resultSet();
                return $results;
            }

            //get customers that can be deleted
            public function getDelCustomers(){
                $this->db->query("SELECT dlicense from Customer 
                Where dlicense NOT IN(select r.dlicense from Reservation r)");
                $results = $this->db->resultSet();
                return $results;
            }

            //get vehicles
            public function getAllVehicle(){
                $this->db->query("SELECT * from Vehicle");
                $results = $this->db->resultSet();
                return $results;
            }

            //get DailyRentals
            public function getAllDailyRentals(){
                $this->db->query("CREATE OR REPLACE VIEW branchtol(loc,city, NumRented, vname)
                    AS SELECT v.location, v.city, COUNT(*), v.vtname
                    FROM Vehicle v, Rent r
                    WHERE v.vlicense = r.vlicense AND DATE(r.fromDate) - current_date = 0
                    GROUP BY v.location, v.city, v.vtname");
                $this->db->execute();

                $this->db->query("CREATE OR REPLACE VIEW totbyv(loc, city,tv) 
                AS SELECT b.loc, b.city,SUM(NumRented)
                From branchtol b
                GROUP BY b.loc, b.city");
                $this->db->execute();

                $this->db->query("CREATE OR REPLACE VIEW total(ta)
                AS SELECT SUM(NumRented)
                From branchtol b");
                $this->db->execute();

                $this->db->query("SELECT b.loc, b.city, b.numRented, b.vname, t.tv, ta.ta
                FROM branchtol b, totbyv t, total ta
                WHERE b.loc = t.loc AND b.city = t.city");
                $results = $this->db->resultSet();
                return $results;
            }

            //get BranchRentals
            public function getAllBranchRentals($location, $city){
                $this->db->query("CREATE OR REPLACE VIEW Btot(vname, num) AS
                SELECT  v.vtname, COUNT(*)
                FROM Vehicle v, Rent r
                WHERE v.vlicense = r.vlicense AND v.location = '".$location."'
                            AND v.city = '".$city."' AND current_date - r.fromDate = 0
                GROUP BY v.vtname");
                $this->db->execute();

                $this->db->query("CREATE OR REPLACE VIEW btotal(ta) AS
                SELECT SUM(b.num) 
                from Btot b");
                $this->db->execute();

                $this->db->query("SELECT * 
                FROM Btot b, btotal bt");
                $results = $this->db->resultSet();
                return $results;
            }

            //get DailyReturns
            public function getAllDailyReturns(){
                $this->db->query("CREATE OR REPLACE VIEW revenue(loc, city, vname, rid,total) AS
                SELECT v.location, v.city, v.vtname, rn.rid,
                    (FLOOR((rn.dater- r.fromDate)/7) * (vt.wrate +vt.wirate) ) + (((rn.dater- r.fromDate) - (FLOOR((rn.dater- r.fromDate)/7)*7) )* (vt.drate + vt.dirate)) + ((rn.odometer - r.odometer)* vt.krate)
                FROM Rent r, ReturnV rn, Vehicle v, VehicleType vt
                WHERE  rn.rid = r.rid AND v.vtname = vt.vtname AND v.vlicense = r.vlicense AND rn.dater - current_date = 0");
                $this->db->execute();

                $this->db->query("CREATE OR REPLACE VIEW branchReturn(loc,city, NumReturned, vname, totByVT) AS
                SELECT v.location, v.city, COUNT(rn.rid), v.vtname, SUM(res.total)
                FROM Vehicle v, Rent r, Returnv rn, revenue res
                WHERE v.vlicense = r.vlicense AND rn.rid = r.rid AND res.loc = v.location
                        AND res.city = v.city AND res.vname = v.vtname AND res.rid = rn.rid AND rn.dater - current_date = 0
                GROUP BY v.location, v.city, v.vtname");
                $this->db->execute();

                $this->db->query("CREATE OR REPLACE VIEW branchRtot(loc,city,totByB) AS
                SELECT br.loc, br.city, SUM(br.totBYVT)
                FROM branchReturn br
                GROUP BY br.loc, br.city");
                $this->db->execute();

                $this->db->query("CREATE OR REPLACE VIEW CRtot(cra) AS
                SELECT SUM(totByB)
                FROM branchRtot");
                $this->db->execute();

                $this->db->query("SELECT br.loc, br.city, br.NumReturned, br.vname, br.totByVT, brt.totByB, ct.cra
                FROM branchReturn br, branchRtot brt, CRtot ct
                WHERE br.loc = brt.loc AND br.city = brt.city");
                $results = $this->db->resultSet();
                return $results;

            }

            //get BranchReturns
            public function getAllBranchReturns($location, $city){
                $this->db->query("CREATE OR REPLACE VIEW revenue(loc, city, vname, rid,total) AS
                SELECT v.location, v.city, v.vtname, rn.rid,
                    (FLOOR((rn.dater- r.fromDate)/7) * (vt.wrate +vt.wirate) ) + (((rn.dater- r.fromDate) - (FLOOR((rn.dater- r.fromDate)/7)*7) )* (vt.drate + vt.dirate)) + ((rn.odometer - r.odometer)* vt.krate)
                FROM Rent r, ReturnV rn, Vehicle v, VehicleType vt
                WHERE  rn.rid = r.rid AND v.vtname = vt.vtname AND v.vlicense = r.vlicense
                    AND v.location = '".$location."' AND v.city = '".$city."' AND rn.dater - current_date = 0");
                $this->db->execute();

                $this->db->query("CREATE OR REPLACE VIEW branchReturn(loc,city, NumReturned, vname, totByVT) AS
                SELECT v.location, v.city, COUNT(rn.rid), v.vtname, SUM(res.total)
                FROM Vehicle v, Rent r, Returnv rn, revenue res
                WHERE v.vlicense = r.vlicense AND rn.rid = r.rid AND res.loc = v.location
                        AND res.city = v.city AND res.vname = v.vtname AND res.rid = rn.rid
                        AND v.location = '".$location."' AND v.city = '".$city."' AND rn.dater - current_date = 0
                GROUP BY v.location, v.city, v.vtname");
                $this->db->execute();

                $this->db->query("CREATE OR REPLACE VIEW branchRtot(loc,city,totByB) AS
                SELECT br.loc, br.city, SUM(br.totBYVT)
                FROM branchReturn br
                GROUP BY br.loc, br.city");
                $this->db->execute();

                $this->db->query("SELECT br.loc, br.city, br.NumReturned, br.vname, br.totByVT, brt.totByB
                FROM branchReturn br, branchRtot brt
                WHERE br.loc = brt.loc AND br.city = brt.city");
                $results = $this->db->resultSet();
                return $results;
            }

            // posts
            //------------------------------------------------------------------------------

            // Create Reservation
            public function insertReservation($data){
                $this->db->query("INSERT INTO Reservation(vtname,
                dlicense,
                fromDate,
                fromTime,
                toDate,
                toTime)
                VALUES(:vtname, :dlicense, :fromDate, :fromTime, :toDate, :toTime)");

                //bind data
                //$this->db->bind(':confNo', 2000);
                $this->db->bind(':vtname', $data['vtname']);
                $this->db->bind(':dlicense', $data['dlicense']);
                $this->db->bind(':fromDate', $data['fromDate']);
                $this->db->bind(':fromTime', $data['fromTime']);
                $this->db->bind(':toDate', $data['toDate']);
                $this->db->bind(':toTime', $data['toTime']);

                //execute
                if($this->db->execute()){
                    return true;
                } else {
                    return false;
                }
            }

            // Create Customer
            public function insertCustomer($data){
                $this->db->query("INSERT INTO Customer(cellphone,
                cname,
                caddress,
                dlicense)
                VALUES(:cellphone, :cname, :caddress, :dlicense)");

                //bind data
                $this->db->bind(':cellphone', $data['cellphone']);
                $this->db->bind(':cname', $data['cname']);
                $this->db->bind(':caddress', $data['caddress']);
                $this->db->bind(':dlicense', $data['dlicense']);

                //execute
                try {
                    $this->db->execute();
                    return true;
                  } catch (PDOException $e) {
                    return false;
                  } catch (Exception $e) {
                    return false;
                  }
            }

            //Insert Rental 
            public function insertRental($data){
                $this->db->query("INSERT INTO Rent(vlicense, dlicense, odometer, fromdate, fromtime, todate, totime, confno)
                SELECT v.vlicense, c.dlicense, v.odometer, r.fromdate, r.fromtime, r.todate, r.totime, r.confno
                FROM Reservation r, Customer c, Vehicle v
                WHERE r.dlicense = c.dlicense AND v.vtname = r.vtname AND 
                        r.confno = :confno AND v.status = 'available'
                ORDER BY v.vlicense desc 
                limit 1");

                //bind data
                $this->db->bind(':confno', $data['confno']);

                //execute
                if($this->db->execute()){
                    $this->db->query("UPDATE Vehicle
                    Set status = 'rented' 
                    Where vlicense IN (select v.vlicense from vehicle v, rent r where r.confno = :confno and r.vlicense = v.vlicense)");
                    $this->db->bind(':confno', $data['confno']);
                    $this->db->execute();
                    return true;
                } else {
                    return false;
                }
            }

            //Insert Rental w/o conf no
            public function insertRentalRes($data){
                $this->db->query("INSERT INTO Rent(vlicense, dlicense, odometer, fromdate, fromtime, todate, totime, confno)
                SELECT v.vlicense, c.dlicense, v.odometer, r.fromdate, r.fromtime, r.todate, r.totime, r.confno
                FROM Reservation r, Customer c, Vehicle v
                WHERE r.dlicense = c.dlicense AND v.vtname = r.vtname AND v.status = 'available' AND
                        r.dlicense = :dlicense AND r.fromdate = :fromdate and r.fromtime = :fromtime and r.todate = :todate and r.totime = :totime
                ORDER BY v.vlicense desc 
                limit 1");

                //bind data
                $this->db->bind(':dlicense', $data['dlicense']);
                $this->db->bind(':fromdate', $data['fromDate']);
                $this->db->bind(':fromtime', $data['fromTime']);
                $this->db->bind(':todate', $data['toDate']);
                $this->db->bind(':totime', $data['toTime']);

                //execute
                if($this->db->execute()){
                    $this->db->query("UPDATE Vehicle
                    Set status = 'rented' 
                    Where vlicense IN (select v.vlicense from vehicle v, rent r, reservation rs where r.confno = rs.confno and r.vlicense = v.vlicense
                    and r.dlicense = :dlicense and r.fromdate = :fromdate and r.fromtime = :fromtime and r.todate = :todate and r.totime = :totime)");
                                    $this->db->bind(':dlicense', $data['dlicense']);
                                    $this->db->bind(':fromdate', $data['fromDate']);
                                    $this->db->bind(':fromtime', $data['fromTime']);
                                    $this->db->bind(':todate', $data['toDate']);
                                    $this->db->bind(':totime', $data['toTime']);
                    $this->db->execute();
                    return true;
                } else {
                    return false;
                }
            }

            //update vehicle availability (set to rented)
            // public function updateRented(){
            //     $this->db->query("UPDATE Vehicle
            //     Set status = 'rented' 
            //     Where vlicense IN (Select vlicense From Rent)");

            //     $this->db->execute();
            // }

            // //update vehicle availability (set to available)
            // public function updateAvailable(){
            //     $this->db->query("UPDATE Vehicle
            //     Set status = 'available' 
            //     Where vlicense IN (Select r.vlicense 
            //                         From Rent r, ReturnV rv
            //                         Where r.rid = rv.rid)");

            //     $this->db->execute();
            // }

            //Insert Return
            public function insertReturn($data){
                $this->db->query("INSERT INTO ReturnV(rid,
                dater,
                timer,
                odometer,
                fulltank)
                VALUES(:rid, :dater, :timer, :odometer, :fulltank)");

                //bind data
                $this->db->bind(':rid', $data['rid']);
                $this->db->bind(':dater', $data['dater']);
                $this->db->bind(':timer', $data['timer']);
                $this->db->bind(':odometer', $data['odometer']);
                $this->db->bind(':fulltank', $data['fulltank']);


                //execute
                if($this->db->execute()){
                    $this->db->query("UPDATE Vehicle
                    Set status = 'available' 
                    Where vlicense IN (Select r.vlicense 
                                        From Rent r
                                        Where r.rid = :rid)");
                    $this->db->bind(':rid', $data['rid']);
                    $this->db->execute();
                    return true;
                } else {
                    return false;
                }
            }

            //Insert Vehicle Type
            public function insertVehicleType($data){
                $this->db->query("INSERT INTO VehicleType(vtname,
                features,
                wrate,
                drate,
                hrate,
                wirate,
                dirate,
                hirate,
                krate
                )
                VALUES(:vtname, :features, :wrate, :drate, :hrate, :wirate, :dirate, :hirate, :krate)");

                //bind data
                $this->db->bind(':vtname', $data['vtname']);
                $this->db->bind(':features', $data['features']);
                $this->db->bind(':wrate', $data['wrate']);
                $this->db->bind(':drate', $data['drate']);
                $this->db->bind(':hrate', $data['hrate']);
                $this->db->bind(':wirate', $data['wirate']);
                $this->db->bind(':dirate', $data['dirate']);
                $this->db->bind(':hirate', $data['hirate']);
                $this->db->bind(':krate', $data['krate']);

                //execute
                try {
                    $this->db->execute();
                    return true;
                  } catch (PDOException $e) {
                    return false;
                  } catch (Exception $e) {
                    return false;
                  }
            }

            //insert vehicle
            public function insertVehicle($data){
                $this->db->query("INSERT INTO vehicle (vlicense,
                make,
                model,
                year,
                color,
                odometer,
                status,
                vtname,
                location,
                city)
                VALUES(:vlicense, :make, :model, :year, :color, :odometer, :status, :vtname, :location, :city)");

                //bind data
                $this->db->bind(':vlicense', $data['vlicense']);
                $this->db->bind(':make', $data['make']);
                $this->db->bind(':model', $data['model']);
                $this->db->bind(':year', $data['year']);
                $this->db->bind(':color', $data['color']);
                $this->db->bind(':odometer', $data['odometer']);
                $this->db->bind(':status', $data['status']);
                $this->db->bind(':vtname', $data['vtname']);
                $this->db->bind(':location', $data['location']);
                $this->db->bind(':city', $data['city']);

                //execute
                try {
                    $this->db->execute();
                    return true;
                  } catch (PDOException $e) {
                    return false;
                  } catch (Exception $e) {
                    return false;
                  }

            }

            //insert Branch
            public function insertBranch($data){
                $this->db->query("INSERT INTO Branch (location, city)
                VALUES(:location, :city)");

                //bind data
                $this->db->bind(':location', $data['location']);
                $this->db->bind(':city', $data['city']);

                //execute
                try {
                    $this->db->execute();
                    return true;
                  } catch (PDOException $e) {
                    return false;
                  } catch (Exception $e) {
                    return false;
                  }

            }

            //deletes
            //-------------------------------------------------------------------------------
            //delete reservation
            public function deleteReservation($confno){
                $this->db->query("DELETE FROM Reservation WHERE confno = ".$confno."");
                if($this->db->execute()){
                    return true;
                } else {
                    return false;
                }
            }

            //delete rental
            public function deleteRental($rid){
                $this->db->query("DELETE FROM Rent WHERE rid = ".$rid."");
                if($this->db->execute()){
                    return true;
                } else {
                    return false;
                }
            }

            //delete return
            public function deleteReturn($rid){
                $this->db->query("DELETE FROM ReturnV WHERE rid = ".$rid."");
                if($this->db->execute()){
                    return true;
                } else {
                    return false;
                }
            }

            //delete return
            public function deleteCustomer($dlicense){
                $this->db->query("DELETE FROM Customer WHERE dlicense = '".$dlicense."'");
                if($this->db->execute()){
                    return true;
                } else {
                    return false;
                }
            }

            //delete branch
            public function deleteBranch($loc, $city){
                $this->db->query("DELETE FROM Branch WHERE location = '".$loc."' AND city = '".$city."'");
                if($this->db->execute()){
                    return true;
                } else {
                    return false;
                }
            }

            //delete vehicle
            public function deleteVehicle($vlicense){
                $this->db->query("DELETE FROM Vehicle WHERE vlicense = '".$vlicense."'");
                if($this->db->execute()){
                    return true;
                } else {
                    return false;
                }
            }

            //delete vehicletype 
            public function deleteVehicleType($vtname){
                $this->db->query("DELETE FROM VehicleType WHERE vtname = '".$vtname."'");
                if($this->db->execute()){
                    return true;
                } else {
                    return false;
                }
            }

            //updates
            //-----------------------------------------------------------

            //update reservation
            public function updateReservation($data) {
                $this->db->query("UPDATE Reservation SET
                vtname = :vtname,
                dlicense = :dlicense,
                fromdate = :fromDate,
                fromtime = :fromTime,
                todate = :toDate,
                totime = :toTime
                WHERE confno = :confno");

                //bind data
                $this->db->bind(':confno', $data['confno']);
                $this->db->bind(':vtname', $data['vtname']);
                $this->db->bind(':dlicense', $data['dlicense']);
                $this->db->bind(':fromDate', $data['fromDate']);
                $this->db->bind(':fromTime', $data['fromTime']);
                $this->db->bind(':toDate', $data['toDate']);
                $this->db->bind(':toTime', $data['toTime']);

                //execute
                try {
                    $this->db->execute();
                    return true;
                  } catch (PDOException $e) {
                    return false;
                  } catch (Exception $e) {
                    return false;
                  }
            }
        }
