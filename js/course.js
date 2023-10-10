document.addEventListener("DOMContentLoaded", () => {
   const course_write =  document.querySelectorAll(".course_write");
   course_write.forEach((box) => {
    box.addEventListener("click", () => {
        self.location.href = "../admin/course_input.php";
    })
   })

})