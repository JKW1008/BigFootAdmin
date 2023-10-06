<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>대발자국 관리자 페이지</title>
    <link rel="stylesheet" href="./css/admin.css">
    <script src="./js/admin.js"></script>
</head>

<body>
    <div class="login-box">
        <h2>관리자</h2>
        <form>
            <div class="user-box">
                <input type="text" name="id" required="" id="id" autocomplete="none">
                <label for="id">관리자 아이디</label>
            </div>
            <div class="user-box">
                <input type="password" name="password" required="" id="password">
                <label for="password">관리자 비밀번호</label>
            </div>
            <a href="#" id="login">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                확인
            </a>
        </form>
    </div>
</body>

</html>