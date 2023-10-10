<?php
    class Course{
        private $conn;

        public function __construct($db){
            $this->conn = $db;
        }

        public function allCousreList(){
            $sql = "SELECT * FROM course ORDER BY course_id ASC";
            $stmt = $this->conn->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            return $stmt->fetchAll(); 
        }


        public function artCousreList(){
            $sql = "SELECT * FROM arts_and_science ORDER BY idx ASC";
            $stmt = $this->conn->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            return $stmt->fetchAll(); 
        }

        public function historyCousreList(){
            $sql = "SELECT * FROM history_and_culture ORDER BY idx ASC";
            $stmt = $this->conn->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            return $stmt->fetchAll(); 
        }

        public function natureCousreList(){
            $sql = "SELECT * FROM nature_and_relaxation ORDER BY idx ASC";
            $stmt = $this->conn->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            return $stmt->fetchAll(); 
        }

        public function tourCousreList(){
            $sql = "SELECT * FROM tourism_and_shopping ORDER BY idx ASC";
            $stmt = $this->conn->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            return $stmt->fetchAll(); 
        }

        public function input($marr) {
            // $category 값을 추출
            $category = isset($marr['category']) ? $marr['category'] : '';
        
            // 단방향 암호화
            $sql = "INSERT INTO $category (photo, detail_photo, name, description, description2, address, operating_hours, contact, website, latitude, longitude, qr_code)
                    VALUES (:photo, :detail_photo, :name, :description, :description2, :address, :operating_hours, :contact, :website, :latitude, :longitude, :qr_code)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':photo', $marr['photo']);
            $stmt->bindParam(':detail_photo', $marr['detail_photo']);
            $stmt->bindParam(':name', $marr['name']);
            $stmt->bindParam(':description', $marr['description']);
            $stmt->bindParam(':description2', $marr['description2']);
            $stmt->bindParam(':address', $marr['address']);
            $stmt->bindParam(':operating_hours', $marr['operating_hours']);
            $stmt->bindParam(':contact', $marr['contact']);
            $stmt->bindParam(':website', $marr['website']);
            $stmt->bindParam(':latitude', $marr['latitude']);
            $stmt->bindParam(':longitude', $marr['longitude']);
            $stmt->bindParam(':qr_code', $marr['qr_code']);
            $stmt->execute();
        }
        
    }
?>