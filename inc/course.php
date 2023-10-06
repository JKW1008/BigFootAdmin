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
            $sql = "SELECT * FROM art_and_science ORDER BY idx ASC";
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
            $sql = "SELECT * FROM tourism_and_shoppin ORDER BY idx ASC";
            $stmt = $this->conn->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            return $stmt->fetchAll(); 
        }
    }
?>