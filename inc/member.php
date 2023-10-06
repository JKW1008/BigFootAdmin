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
    }        
?>