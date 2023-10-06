<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/adminMain.css">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>

</head>

<body>
    <header>
        <div class="area"></div>
        <nav class="main-menu">
            <ul>
                <li>
                    <a href="./index.php">
                        <i class="fa fa-home fa-2x"></i>
                        <span class="nav-text">
                            관리자 메인
                        </span>
                    </a>

                </li>
                <li class="has-subnav">
                    <a href="./member.php">
                        <i class="fa fa-user fa-2x"></i>
                        <span class="nav-text">
                            회원 관리
                        </span>
                    </a>

                </li>
                <li class="has-subnav">
                    <a href="#">
                        <i class="fa fa-comments fa-2x"></i>
                        <span class="nav-text">
                            게시판 관리
                        </span>
                    </a>

                </li>
                <li class="has-subnav">
                    <a href="./course.php">
                        <i class="fa fa-road fa-2x"></i>
                        <span class="nav-text">
                            코스 관리
                        </span>
                    </a>
                </li>
            </ul>
            <ul class="logout">
                <li>
                    <a href="#">
                        <i class="fa fa-power-off fa-2x"></i>
                        <span class="nav-text">
                            Logout
                        </span>
                    </a>
                </li>
            </ul>
        </nav>
    </header>