<?php
include "./inc_header.php";
include "./inc/dbconfig.php";

session_start();

if (!isset($_SESSION['ses_id']) || $_SESSION['ses_id'] !== 'admin') {
    die("
        <script>
            alert('관리자만 접근 가능합니다.');
            self.location.href = '../index.php';
        </script>    
    ");
}

// 나머지 페이지 내용을 추가하세요.
?>
<div class="container">
    <div class="mainInnerWrap">
        <h1>홈 입니다</h1>
    </div>
</div>
</body>

</html>