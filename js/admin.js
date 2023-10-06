document.addEventListener("DOMContentLoaded", () => {
    const id = document.querySelector("#id");
    const password = document.querySelector("#password");
    const login = document.querySelector("#login");

    login.addEventListener("click", () => {
        if(id.value == ""){
            alert("아이디를 입력해 주세요.");
            id.focus();
            return false;
        }
        
        if(password.value == ""){
            alert("비밀번호를 입력해 주세요.");
            password.focus();
            return false;
        }

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "./pg/login_process.php", true);

        const f = new FormData();
        f.append("id", id.value);
        f.append("pw", password.value);

        xhr.send(f);

        xhr.onload = () => {
            if(xhr.status == 200){
                const data = JSON.parse(xhr.responseText);
                if(data.result == "login_fail"){
                    alert("아이디 혹은 비밀번호를 잘못입력하셨습니다.");
                    id.value = "";
                    password.value = "";
                    id.focus();
                    return false;
                } else if (data.result == "login_success") {
                    alert("로그인에 성공했습니다.");
                    self.location.href = "./admin/index.php";
                }
            }else if(xhr.status == 404){
                alert("연결 실패");
            }
        }
    })
});