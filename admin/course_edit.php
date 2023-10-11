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

    include '../inc/course.php';

    $idx = (isset($_GET['idx']) && $_GET['idx'] != '') ? $_GET['idx'] : '';
    $table_name = (isset($_GET['table_name']) && $_GET['table_name'] != '') ? $_GET['table_name'] : '';

    $cour = new Course($db);

    $coursFindArr = $cour->coursFind($table_name, $idx);

    // print_r($coursFindArr);
?>
<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script src="../js/course_edit.js"></script>
<main class="container">
    <h1 class="text-center h1 mt-5">코스 입력하기</h1>
    <form name="input_form" method="post" enctype="multipart/form-data" autocomplete="off" action="">
        <input type="hidden" id="old_photo" value="<?= $coursFindArr['photo']; ?>">
        <input type="hidden" id="old_detail_photo" value="<?= $coursFindArr['detail_photo']; ?>">
        <input type="hidden" name="mode" value="input">
        <div class="w-100 mt-3">
            <label for="">카테고리</label>
            <select name="choice_category" id="choice_category" class="form-select" disabled>
                <option value="arts_and_science"
                    <?php if($coursFindArr['table_name'] == "arts_and_science") echo " selected"; ?>>예술과 과학</option>
                <option value="history_and_culture"
                    <?php if($coursFindArr['table_name'] == "history_and_culture") echo " selected"; ?>>역사와 문화
                </option>
                <option value="nature_and_relaxation"
                    <?php if($coursFindArr['table_name'] == "nature_and_relaxation") echo " selected"; ?>>자연과 휴식
                </option>
                <option value="tourism_and_shopping"
                    <?php if($coursFindArr['table_name'] == "tourism_and_shopping") echo " selected"; ?>>관광과 쇼핑
                </option>
            </select>
        </div>
        <div class="d-flex w-100">
            <div class="w-100">
                <label for="name" class="form-label mt-3">장소 이름</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="이름을 입력해 주세요."
                    value="<?= $coursFindArr['name']; ?>">
            </div>
        </div>
        <div class="mt-3">
            <label for="description" class="form-label mt-3">설명</label>
            <textarea name="description" id="description" class="form-control" rows="4" placeholder="첫번째 설명을 입력해 주세요.">
<?= $coursFindArr['description']; ?>
</textarea>
        </div>
        <div class="mt-3">
            <label for="description1" class="form-label mt-3">설명</label>
            <textarea name="description1" id="description1" class="form-control" rows="4"
                placeholder="두번째 설명을 입력해 주세요."><?= $coursFindArr['description2']; ?></textarea>
        </div>
        <div class="d-flex align-items-end mt-3 gap-2">
            <div>
                <label for="zipcode">우편번호</label>
                <input type="text" name="zipcode" id="zipcode" readonly class="form-control" maxlength="5"
                    minlength="5">
            </div>
            <button class="btn btn-secondary" type="button" id="btn_zipcode">우편번호 찾기</button>
        </div>
        <div class="d-flex mt-3 gap-2 justify-content-between">
            <div class="w-100">
                <label for="addr" class="form-label">주소</label>
                <input type="text" class="form-control" name="addr" id="addr" placeholder=""
                    value="<?= $coursFindArr['address'] ?>">
            </div>
        </div>
        <div class="d-flex w-100 mt-3">
            <div class="w-100">
                <label for="hour" class="form-label">영업 시간</label>
                <input type="text" name="hour" class="form-control" id="hour" placeholder="영업시간을 입력해 주세요."
                    value="<?= $coursFindArr['operating_hours']; ?>">
            </div>
        </div>
        <div class="d-flex w-100 mt-3">
            <div class="w-100">
                <label for="number" class="form-label">연락처</label>
                <input type="text" name="number" class="form-control" id="number" placeholder="공식 연락처를 입력해 주세요."
                    value="<?= $coursFindArr['contact'] ?>">
            </div>
        </div>
        <div class="d-flex w-100 mt-3">
            <div class="w-100">
                <label for="web" class="form-label">웹사이트</label>
                <input type="text" name="web" class="form-control" id="web" placeholder="사이트를 입력해 주세요."
                    value="<?= $coursFindArr['website'] ?>">
            </div>
        </div>
        <div class="d-flex w-100 mt-3 gap-2">
            <div class="w-50">
                <label for="lati" class="form-label">위도</label>
                <input type="text" name="lati" class="form-control" id="lati" placeholder="위도를 입력해 주세요."
                    value="<?= $coursFindArr['latitude'] ?>">
            </div>
            <div class="w-50">
                <label for="long" class="form-label">경도</label>
                <input type="text" name="long" class="form-control" id="long" placeholder="경도를 입력해 주세요."
                    value="<?= $coursFindArr['longitude'] ?>">
            </div>
        </div>
        <div class="mt-3 d-flex flex-column gap-5">
            <div>
                <label for="detail_photo" class="form-label">디테일 이미지</label>
                <input type="file" name="detail_photo" id="detail_photo" class="form-control"
                    value="<?= $coursFindArr['detail_photo'] ?>">
            </div>
            <?php if($coursFindArr['detail_photo'] != ''){
                echo '<img src="../data/detail/'.$coursFindArr['detail_photo'].'" class="w-25 mx-auto" alt="detail image">';
            }else{
                echo '
                    <img src="./images/pngegg.png" id="f_preview" class="w-25 mx-auto" alt="profile image">
                    ';
            }
            ?>
        </div>
        <div class="mt-3 d-fle x flex-column gap-5">
            <div>
                <label for="main_photo" class="form-label">메인 이미지</label>
                <input type="file" name="main_photo" id="main_photo" class="form-control" value="<?= $coursFindArr['photo'] ?>>
            </div>
            <?php if($coursFindArr['photo'] != ''){
                echo '<img src="../data/course/'.$coursFindArr['photo'].'" class="w-25 mx-auto" alt="detail image" id="m_photo">';
            }
            ?>
        </div>
        <div class=" d-flex w-100 mt-3">
                <div class="w-100">
                    <label for="qr" class="form-label">QR code</label>
                    <input type="text" name="qr" class="form-control" id="qr" placeholder="큐알 코드를 입력해 주세요."
                        value="<?= $coursFindArr['qr_code']; ?>">
                </div>
            </div>
            <div class="mt-3 d-flex gap-2 mt-5">
                <button id="btn_submit" class="btn btn-primary w-50" type="button">확인</button>
                <button class="btn btn-secondary w-50" type="button" id="btn_list">목록</button>
            </div>
    </form>
</main>