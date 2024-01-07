import './bootstrap';
let prevScrollpos = window.pageYOffset;
const imageInput = document.getElementById('img');
const imagePreview = document.getElementById('preview');
const oldImage = document.getElementById('old')

$(document).ready(function() {
  $("#show1").click(function() {
      $(".row1").show();
      $(".row2").hide();
  });

  $("#show2").click(function() {
      $(".row2").show();
      $(".row1").hide();
  });
  
  $('.toggle-btn').on('click', function(event) {
      event.preventDefault();
      $('.navbar-links').toggleClass('active');
  });
});


window.onscroll = function () {
    const currentScrollPos = window.pageYOffset;
    if (prevScrollpos > currentScrollPos) {
        document.getElementById("navbar").style.top = "0";
    } else {
        document.getElementById("navbar").style.top = "-130px";
    }
    prevScrollpos = currentScrollPos;
}


imageInput.addEventListener('change', function() {
  const file = this.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = function(e) {
        imagePreview.style.display = 'block';
        oldImage.style.display = 'none';
        imagePreview.src = e.target.result;
    }
    reader.readAsDataURL(file);
  } else {
    imagePreview.src = '';
  }
});
