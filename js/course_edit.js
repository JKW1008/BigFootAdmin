function getUrlParams() {
  const params = {};

  window.location.search.replace(
    /[?&]+([^=&]+)=([^&]*)/gi,
    function (str, key, value) {
      params[key] = value;
    }
  );

  return params;
}


document.addEventListener("DOMContentLoaded", () => {
  const params = getUrlParams();

  const choice_category = document.querySelector("#choice_category");
  const name = document.querySelector("#name");
  const description = document.querySelector("#description");
  const description1 = document.querySelector("#description1");
  const zipcode = document.querySelector("#zipcode");
  const btn_zipcode = document.querySelector("#btn_zipcode");
  const addr = document.querySelector("#addr");
  const hour = document.querySelector("#hour");
  const number = document.querySelector("#number");
  const web = document.querySelector("#web");
  const lati = document.querySelector("#lati");
  const long = document.querySelector("#long");
  const detail_photo = document.querySelector("#detail_photo");
  const old_detail_photo = document.querySelector("#old_detail_photo");
  const main_photo = document.querySelector("#main_photo");
  const old_photo = document.querySelector("#old_photo");
  const qr = document.querySelector("#qr");
  const btn_submit = document.querySelector("#btn_submit");

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

  const btn_list = document.querySelector("#btn_list");
  btn_list.addEventListener("click", () => {
    self.location.href = "../admin/course.php";
  });

  btn_submit.addEventListener("click", () => {

    const f = new FormData();
    f.append("idx", params['idx']);
    f.append("category", choice_category.value);
    f.append("photo", main_photo.files.length > 0 ? main_photo.files[0] : old_photo.value);
    f.append("detail_photo", detail_photo.files.length > 0 ? detail_photo.files[0] : old_detail_photo.value);
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
    f.append("mode", "edit");

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "../pg/course_process.php", true);
    xhr.send(f);

    xhr.onload = () => {
      const data = JSON.parse(xhr.responseText);
      if (data.result == "course_edit_success") {
        alert('수정되었습니다.');
        self.location.href = '../admin/course.php';
      }
    }
  })
})
