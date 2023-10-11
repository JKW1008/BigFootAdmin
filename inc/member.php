<?php
    class Member{
        private $conn;

        public function __construct($db){
            $this->conn = $db;
        }

        public function login($id, $pw){

            // password_verify($password, $new_password);
        
            $sql = "SELECT * FROM people WHERE user_email=:id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id',  $id);
        
            $stmt->execute();
        
            if($stmt->rowCount()){
                $row = $stmt->fetch();
        
                if(password_verify($pw, $row['user_password']) && $row['admin'] == 1){
                    // 로그인 성공 및 관리자 권한 확인
                    return true; // 사용자 정보를 반환
                }else{
                    // 비밀번호 불일치 또는 관리자 권한 없음
                    return false;
                }
            }else{
                // 사용자가 존재하지 않음
                return false;
            }
        }

        public function getInfo($id){
            $sql = "SELECT * FROM people WHERE user_email=:id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            return $stmt->fetch();
        }

        public function total($paramArr){

            $where = "";

            if($paramArr['sn'] != '' && $paramArr['sf'] != ''){
                switch($paramArr['sn']){
                    case 1 : $sn_str = 'name'; break;
                    case 2 : $sn_str = 'email'; break;
                }

                $where = "  WHERE ".$sn_str."=:sf ";
            }

            $sql = "SELECT COUNT(*) cnt FROM people ". $where;
            $stmt = $this->conn->prepare($sql);

            if($where != ''){
                $stmt->bindParam(':sf', $paramArr['sf']);
            }

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            $row = $stmt->fetch();
            return $row['cnt'];
        }

        public function list($page, $limit, $paramArr){
            $start = ($page - 1) * $limit;
            $where = "";

            if($paramArr['sn'] != '' && $paramArr['sf'] != ''){
                switch($paramArr['sn']){
                    case 1 : $sn_str = 'name'; break;
                    case 2 : $sn_str = 'email'; break;
                }

                $where = " WHERE ".$sn_str."=:sf ";
            }

            $sql = "SELECT user_id, user_email, user_name FROM people  ". $where ." 
                    ORDER BY user_id DESC LIMIT ".$start.",".$limit;     // 1페이지면 0, 5, 2페이지면 5, 5, 10, 5, 10, 5
                    
            $stmt = $this->conn->prepare($sql);

            if($where != ''){
                $stmt->bindParam(':sf', $paramArr['sf']);
            }

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            return $stmt->fetchAll();
        }

    }        
?>