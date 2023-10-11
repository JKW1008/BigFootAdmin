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

    include "./inc_header.php";
    include "../inc/dbconfig.php";

    $db = $pdo;
     
    include "../inc/member.php";

    $sn = (isset($_GET['sn']) && $_GET['sn'] != '' && is_numeric($_GET['sn'])) ? $_GET['sn'] : '';
    $sf = (isset($_GET['sf']) && $_GET['sf'] != '') ? $_GET['sf'] : '';

    $paramArr = [ 'sn' => $sn, 'sf' => $sf];

    $mem = new Member($db);

    include "../inc/lib.php";

    $total = $mem->total($paramArr);
    $limit = 20;
    $page_limit = 10;
    $page = (isset($_GET['page']) && $_GET['page'] != '' && is_numeric($_GET['page'])) ? $_GET['page'] : 1;

    $param = '';

    $memArr = $mem -> list($page, $limit, $paramArr);
?>

<div class="container">
    <div class="mainInnerWrap">
        <main class="border rounded-2 p-5">
            <h3>회원관리</h3>
            <table class="table table-border">
                <colgroup>
                    <col width="25%">
                    <col width="25%">
                    <col width="25%">
                    <col width="25%">
                </colgroup>
                <tr>
                    <th>번호</th>
                    <th>아이디</th>
                    <th>이름</th>
                    <th>관리</th>
                </tr>
                <?php
            foreach($memArr AS $row){
                // $row['create_at'] = substr($row['create_at'], 0, 16);
        ?>
                <tr>
                    <td><?= $row['user_id']; ?></td>
                    <td><?= $row['user_email']; ?></td>
                    <td><?= $row['user_name']; ?></td>
                    <td>
                        <button class="btn btn-primary btn-sm btn_mem_edit"
                            data-idx="<?= $row['user_id']; ?>">수정</button>
                        <button class="btn btn-danger btn-sm btn_mem_delete"
                            data-idx="<?= $row['user_id']; ?>">삭제</button>
                    </td>
                </tr>
                <?php
            }
        ?>
            </table>
            <div class="container mt-3 d-flex gap-2 w-50">
                <select name="sn" id="sn" class="form-select w-25">
                    <option value="1">이름</option>
                    <option value="2">아이디</option>
                    <option value="3">이메일</option>
                </select>
                <input type="text" class="form-control w-25" id="sf" name="sf">
                <button class="btn btn-primary w-25" id="btn_search">검색</button>
                <button class="btn btn-success w-25" id="btn_all">전체목록</button>
            </div>
            <div class="d-flex mt-3 justify-content-between align-items-start">
                <?php
            $param = '&sn='. $sn. '&sf='. $sf;

            echo my_pagination($total, $limit, $page_limit, $page, $param);
        ?>
                <button class="btn btn-primary" id="btn_excel">엑셀로 저장</button>
            </div>
        </main>
    </div>
</div>
</body>

</html>