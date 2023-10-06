<?php
    include "./inc_header.php";

    include "../inc/dbconfig.php";

    $db = $pdo;
    
    include '../inc/course.php';

    $course = new Course($db);

    $allCourseArr = $course->allCousreList();
    $artCourseArr = $course->artCousreList();
    $historyCourseArr = $course->historyCousreList();
    $natureCourseArr = $course->natureCousreList();
    $tourismCourseArr = $course->tourCousreList();
?>
<style>
button {
    color: black;
}
</style>
<div class="container">
    <div class="mainInnerWrap">
        <h1>코스</h1>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#tab-pane"
                    type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">전체 코스</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="tab1" data-bs-toggle="tab" data-bs-target="#tab1-pane" type="button"
                    role="tab" aria-controls="tab1-pane" aria-selected="false">예술과 과학</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="tab2" data-bs-toggle="tab" data-bs-target="#tab2-pane" type="button"
                    role="tab" aria-controls="tab2-pane" aria-selected="false">역사와 문화</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="tab3" data-bs-toggle="tab" data-bs-target="#tab3-pane" type="button"
                    role="tab" aria-controls="tab3-pane" aria-selected="false">자연과 휴식</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="tab4" data-bs-toggle="tab" data-bs-target="#tab4-pane" type="button"
                    role="tab" aria-controls="tab4-pane" aria-selected="false">관광과 휴식</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tab-pane" role="tabpanel" aria-labelledby="tab" tabindex="0">
                <main class="p-5">
                    <h3>전체 코스 관리</h3>
                    <table class="table table-border">
                        <colgroup>
                            <col width="10%">
                            <col width="15 %">
                            <col width="25%">
                            <col width="25%">
                            <col width="15%">
                        </colgroup>
                        <tr>
                            <th>코스 번호</th>
                            <th>코스 이름</th>
                            <th>위도</th>
                            <th>경도</th>
                            <th>QR code</th>
                            <th>관리</th>
                        </tr>
                        <?php
            foreach($allCourseArr AS $row){
                // $row['create_at'] = substr($row['create_at'], 0, 16);
        ?>
                        <tr>
                            <td><?= $row['course_id']; ?></td>
                            <td><?= $row['course_name']; ?></td>
                            <td><?= $row['course_latitude']; ?></td>
                            <td><?= $row['course_longitude']; ?></td>
                            <td><?= $row['course_qr']; ?></td>
                            <td>
                                <button class="btn btn-primary btn-sm btn_mem_edit"
                                    data-idx="<?= $row['course_id']; ?>">수정</button>
                                <button class="btn btn-danger btn-sm btn_mem_delete"
                                    data-idx="<?= $row['course_id']; ?>">삭제</button>
                            </td>
                        </tr>
                        <?php
            }
        ?>
                    </table>
            </div>
            <div class="tab-pane fade" id="tab1-pane" role="tabpanel" aria-labelledby="tab1" tabindex="0">
                2</div>
            <div class="tab-pane fade" id="tab2-pane" role="tabpanel" aria-labelledby="tab2" tabindex="0">
                3</div>
            <div class="tab-pane fade" id="tab3-pane" role="tabpanel" aria-labelledby="tab3" tabindex="0">4
            </div>
            <div class="tab-pane fade" id="tab4-pane" role="tabpanel" aria-labelledby="tab4" tabindex="0">5
            </div>
        </div>
    </div>
</div>