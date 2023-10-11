<?php
session_start();

if (!isset($_SESSION['ses_id']) || $_SESSION['ses_id'] !== 'admin') {
    die("
        <script>
            alert('관리자만 접근 가능합니다.');
            self.location.href = '../index.php';
        </script>    
    ");
}
?>