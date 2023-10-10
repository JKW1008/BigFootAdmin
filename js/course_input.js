document.addEventListener("DOMContentLoaded", () => {
    const choice_category = document.querySelector("#choice_category");
    const name = document.querySelector("#name");
    const description = document.querySelector("#description");
    const description1 = document.querySelector("#description1");
    const zipcode = document.querySelector("#zipcode");
    const btn_zipcode = document.querySelector("#btn_zipcode");
    const addr = document.querySelector("#addr")
    const hour = document.querySelector("#hour");
    const number = document.querySelector("#number");
    const web = document.querySelector("#web");
    const lati = document.querySelector("#lati");
    const long = document.querySelector("#long");
    const detail_photo = document.querySelector("#detail_photo");
    const main_photo = document.querySelector("#main_photo");
    const qr = document.querySelector("#qr");
    const btn_submint = document.querySelector("#btn_submit");


    btn_zipcode.addEventListener("click", () => {
      new daum.Postcode({
        oncomplete: function (data) {
          let sub_addr = "";
          let extra_addr = "";
  
          if (data.userSelectedType == "J") {
            sub_addr = data.jibunAddress;
          } else if (data.userSelectedType == "R") {
            sub_addr = data.roadAddress;
          }
  
          if (data.bname != "") {
            extra_addr = data.bname;
          }
  
          if (data.buildingName != "") {
            if (extra_addr == "") {
              extra_addr = data.buildingName;
            } else {
              extra_addr += ", " + data.buildingName;
            }
          }
  
          if (extra_addr != "") {
            extra_addr = " (" + extra_addr + ")";
          }
  
          addr.value = sub_addr + extra_addr;
  
          zipcode.value = data.zonecode;

        },
      }).open();
    });

    btn_submint.addEventListener("click", () => {
      // console.log(choice_category.value);
      // console.log(name.value);
      // console.log(description.value);
      // console.log(description1.value);
      // console.log(zipcode.value);
      // console.log(hour.value);
      // console.log(number.value);
      // console.log(web.value);
      // console.log(lati.value);
      // console.log(long.value);
      // console.log(detail_photo.value);
      // console.log(main_photo.value);
      // console.log(qr.value);

      const f = new FormData();
      f.append("category", choice_category.value);
      f.append("photo", main_photo.files[0]);
      f.append("detail_photo", detail_photo.files[0]);
      f.append("name", name.value);
      f.append("description", description.value);
      f.append("description1", description1.value);
      f.append("address", addr.value);
      f.append("operating_hours", hour.value);
      f.append("contact", number.value);
      f.append("website", web.value);
      f.append("latitude", lati.value);
      f.append("longitude", long.value);
      f.append("qr_code", qr.value);
      f.append("mode", "input");

      const xhr = new XMLHttpRequest();
      xhr.open("POST", "../pg/course_process.php");
      xhr.send(f);

      xhr.onload = () => {
        if(xhr.status == 200){
          const data = JSON.parse(xhr.responseText);
          // console.log(data.result);

          if (data.result == "empty_category") {
            alert("카테고리를 선택해 주세요.");
            choice_category.focus();
          } else if (data.result == "empty_name") {
            alert("장소명를 입력해 주세요.");
            name.focus();
          } 
          else if (data.result == "empty_description") {
            alert("첫번째 설명을 입력해 주세요");
            description.focus();
          } 
          else if (data.result == "empty_description1") {
            alert("두번째 설명을 입력해 주세요");
            description1.focus();
          } 
          else if (data.result == "empty_address") {
            alert("코스 주소를 입력해 주세요");
            addr.focus();
          } 
          else if (data.result == "empty_operating_hours") {
            alert("운영시간을 입력해 주세요");
            hour.focus();
          } 
          else if (data.result == "empty_contact") {
            alert("공식 연락처를 입력해 주세요");
            number.focus();
          } 
          else if (data.result == "empty_website") {
            alert("사이트를 입력해 주세요");
            web.focus();
          } 
          else if (data.result == "empty_latitude") {
            alert("위도를 입력해 주세요");
            lati.focus();
          } 
          else if (data.result == "empty_longitude") {
            alert("경도를 입력해 주세요");
            hour.focus();
          } 
          else if (data.result == "empty_qr_code") {
            alert("qr코드를 입력해 주세요");
            long.focus();
          } 
          else if (data.result == "course_input_success") {
            alert("입력되었습니다.");
            self.location.href = "../admin/course.php";
          }
        } else if (xhr.status == 404){
        }
      }
    });
})