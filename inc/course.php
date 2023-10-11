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
        

        public function coursFind($table_name, $idx){
            $sql = "SELECT * FROM $table_name WHERE idx=:idx";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":idx", $idx);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            return $stmt->fetch();
        }

        public function photo_upload($id, $new_photo, $old_photo = ''){
            if ($old_photo != '') {
                unlink("../data/course" ."/". $old_photo);
                // unlink(PROFILE_DIR . $old_photo); //  삭제
            }
        
            $tmparr = explode('.', $new_photo['name']);
            $ext = end($tmparr);
            $photo = $id . '.' . $ext;
        
            copy($new_photo['tmp_name'], "../data/course" ."/". $photo);
        
            return $photo;
        }

        public function detail_photo_upload($id, $new_photo, $old_photo = ''){
            if ($old_photo != '') {
                unlink("../data/detail" ."/". $old_photo);
                // unlink(PROFILE_DIR . $old_photo); //  삭제
            }
        
            $tmparr = explode('.', $new_photo['name']);
            $ext = end($tmparr);
            $photo = $id . '.' . $ext;
        
            copy($new_photo['tmp_name'], "../data/detail" ."/". $photo);
        
            return $photo;
        }

        public function edit($table, $marr) {
            // 단방향 암호화
            $sql = "UPDATE $table SET
            name = :name,
            description = :description,
            description2 = :description2,
            address = :address,
            operating_hours = :operating_hours,
            contact = :contact,
            website = :website,
            latitude = :latitude,
            longitude = :longitude,
            qr_code = :qr_code";
        
            // 사진 파일 업데이트 조건 추가
            if (!empty($marr['photo'])) {
                $sql .= ", photo = :photo";
            }
        
            // 디테일 사진 파일 업데이트 조건 추가
            if (!empty($marr['detail_photo'])) {
                $sql .= ", detail_photo = :detail_photo";
            }
        
            $sql .= " WHERE idx = :idx";
        
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':idx', $marr['idx']);
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
        
            // 사진 파일 매개변수 추가
            if (!empty($marr['photo'])) {
                $stmt->bindParam(':photo', $marr['photo']);
            }
        
            // 디테일 사진 파일 매개변수 추가
            if (!empty($marr['detail_photo'])) {
                $stmt->bindParam(':detail_photo', $marr['detail_photo']);
            }
        
            $stmt->execute();
        }
        
    }
?>