document.addEventListener("DOMContentLoaded", () => {
   const course_write =  document.querySelectorAll(".course_write");
   course_write.forEach((box) => {
    box.addEventListener("click", () => {
        self.location.href = "../admin/course_input.php"
    })
   });

   const btn_course_edit = document.querySelectorAll(".btn_course_edit");
   btn_course_edit.forEach((box) => {
    box.addEventListener("click", () => {
      self.location.href = "../admin/course_edit.php?table_name=" + box.dataset.tableName + "&idx=" + box.dataset.idx;
    })
   });
})