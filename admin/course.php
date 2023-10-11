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
<script src="../js/course.js"></script>
<style>
button {
    color: black;
}
</style>
<div class="container">
    <div class="mainInnerWrap">
        <h1>코스</h1>
        <ul class="nav nav-tabs pt-5" id="myTab" role="tablist">
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
                    role="tab" aria-controls="tab4-pane" aria-selected="false">관광과 쇼핑</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <!-- 모든 코스 -->
            <div class="tab-pane fade show active" id="tab-pane" role="tabpanel" aria-labelledby="tab" tabindex="0">
                <div class="py-5">
                    <table class="table table-border">
                        <colgroup>
                            <col width="10%">
                            <col width="20%">
                            <col width="20%">
                            <col width="20%">
                            <col width="20%">
                            <col width="10%">
                        </colgroup>
                        <tr>
                            <th>번호</th>
                            <th>코스 이름</th>
                            <th>위도</th>
                            <th>경도</th>
                            <th>카테고리</th>
                            <th>QR code</th>
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
                            <td><?= $row['table_name']; ?></td>
                            <td><?= $row['course_qr']; ?></td>

                        </tr>
                        <?php
            }
        ?>
                    </table>
                </div>
                <button class="btn btn-primary course_write">코스 넣기</button>
            </div>
            <!-- 예술과 과학 -->
            <div class="tab-pane fade" id="tab1-pane" role="tabpanel" aria-labelledby="tab1" tabindex="0">
                <div class="py-5">
                    <table class="table table-border">
                        <colgroup>
                            <col width="5%">
                            <col width="15%">
                            <col width="15%">
                            <col width="15%">
                            <col width="20%">
                            <col width="20%">
                            <col width="25%">
                        </colgroup>
                        <tr>
                            <th>번호</th>
                            <th>코스 이름</th>
                            <th>위도</th>
                            <th>경도</th>
                            <th>카테고리</th>
                            <th>QR code</th>
                            <th>관리</th>
                        </tr>
                        <?php
            foreach($artCourseArr AS $row){
                // $row['create_at'] = substr($row['create_at'], 0, 16);
        ?>
                        <tr>
                            <td><?= $row['idx']; ?></td>
                            <td><?= $row['name']; ?></td>
                            <td><?= $row['latitude']; ?></td>
                            <td><?= $row['longitude']; ?></td>
                            <td><?= $row['table_name']; ?></td>
                            <td><?= $row['qr_code']; ?></td>
                            <td>
                                <button class="btn btn-primary btn-sm btn_course_edit" data-idx="<?= $row['idx']; ?>"
                                    data-table-name="<?= $row['table_name']; ?>">수정</button>
                                <button class="btn btn-danger btn-sm btn_course_delete"
                                    data-idx="<?= $row['idx']; ?>">삭제</button>
                            </td>
                        </tr>

                        <?php
            }
        ?>
                    </table>

                </div>
                <button class="btn btn-primary course_write">코스 넣기</button>

            </div>
            <!-- 역사와 문화 -->
            <div class="tab-pane fade" id="tab2-pane" role="tabpanel" aria-labelledby="tab2" tabindex="0">
                <div class="py-5">
                    <table class="table table-border">
                        <colgroup>
                            <col width="5%">
                            <col width="15%">
                            <col width="15%">
                            <col width="15%">
                            <col width="20%">
                            <col width="20%">
                            <col width="25%">
                        </colgroup>
                        <tr>
                            <th>번호</th>
                            <th>코스 이름</th>
                            <th>위도</th>
                            <th>경도</th>
                            <th>카테고리</th>
                            <th>QR code</th>
                            <th>관리</th>
                        </tr>
                        <?php
            foreach($historyCourseArr AS $row){
                // $row['create_at'] = substr($row['create_at'], 0, 16);
        ?>
                        <tr>
                            <td><?= $row['idx']; ?></td>
                            <td><?= $row['name']; ?></td>
                            <td><?= $row['latitude']; ?></td>
                            <td><?= $row['longitude']; ?></td>
                            <td><?= $row['table_name']; ?></td>
                            <td><?= $row['qr_code']; ?></td>
                            <td>
                                <button class="btn btn-primary btn-sm btn_course_edit" data-idx="<?= $row['idx']; ?>"
                                    data-table-name="<?= $row['table_name']; ?>">수정</button>
                                <button class="btn btn-danger btn-sm btn_course_delete"
                                    data-idx="<?= $row['idx']; ?>">삭제</button>
                            </td>
                        </tr>
                        <?php
            }
        ?>
                    </table>
                </div>
                <button class="btn btn-primary course_write">코스 넣기</button>

            </div>
            <!-- 자연과 휴식 -->
            <div class="tab-pane fade" id="tab3-pane" role="tabpanel" aria-labelledby="tab3" tabindex="0">
                <div class="py-5">
                    <table class="table table-border">
                        <colgroup>
                            <col width="5%">
                            <col width="15%">
                            <col width="15%">
                            <col width="15%">
                            <col width="20%">
                            <col width="20%">
                            <col width="25%">
                        </colgroup>
                        <tr>
                            <th>번호</th>
                            <th>코스 이름</th>
                            <th>위도</th>
                            <th>경도</th>
                            <th>카테고리</th>
                            <th>QR code</th>
                            <th>관리</th>
                        </tr>
                        <?php
            foreach($natureCourseArr AS $row){
                // $row['create_at'] = substr($row['create_at'], 0, 16);
        ?>
                        <tr>
                            <td><?= $row['idx']; ?></td>
                            <td><?= $row['name']; ?></td>
                            <td><?= $row['latitude']; ?></td>
                            <td><?= $row['longitude']; ?></td>
                            <td><?= $row['table_name']; ?></td>
                            <td><?= $row['qr_code']; ?></td>
                            <td>
                                <button class="btn btn-primary btn-sm btn_course_edit" data-idx="<?= $row['idx']; ?>"
                                    data-table-name="<?= $row['table_name']; ?>">수정</button>
                                <button class="btn btn-danger btn-sm btn_course_delete"
                                    data-idx="<?= $row['idx']; ?>">삭제</button>
                            </td>
                        </tr>
                        <?php
            }
        ?>
                    </table>
                </div>
                <button class="btn btn-primary course_write">코스 넣기</button>

            </div>
            <!-- 관광과 쇼핑 -->
            <div class="tab-pane fade" id="tab4-pane" role="tabpanel" aria-labelledby="tab4" tabindex="0">
                <div class="py-5">
                    <table class="table table-border">
                        <colgroup>
                            <col width="5%">
                            <col width="15%">
                            <col width="15%">
                            <col width="15%">
                            <col width="20%">
                            <col width="20%">
                            <col width="25%">
                        </colgroup>
                        <tr>
                            <th>번호</th>
                            <th>코스 이름</th>
                            <th>위도</th>
                            <th>경도</th>
                            <th>카테고리</th>
                            <th>QR code</th>
                            <th>관리</th>
                        </tr>
                        <?php
            foreach($tourismCourseArr AS $row){
                // $row['create_at'] = substr($row['create_at'], 0, 16);
        ?>
                        <tr>
                            <td><?= $row['idx']; ?></td>
                            <td><?= $row['name']; ?></td>
                            <td><?= $row['latitude']; ?></td>
                            <td><?= $row['longitude']; ?></td>
                            <td><?= $row['table_name']; ?></td>
                            <td><?= $row['qr_code']; ?></td>
                            <td>
                                <button class="btn btn-primary btn-sm btn_course_edit" data-idx="<?= $row['idx']; ?>"
                                    data-table-name="<?= $row['table_name']; ?>">수정</button>
                                <button class="btn btn-danger btn-sm btn_course_delete"
                                    data-idx="<?= $row['idx']; ?>">삭제</button>
                            </td>
                        </tr>
                        <?php
            }
        ?>
                    </table>
                </div>
                <button class="btn btn-primary course_write">코스 넣기</button>

            </div>
        </div>


    </div>
</div>