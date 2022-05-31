$(document).ready(function () {

  var prevScrollpos = window.pageYOffset;
  window.onscroll = function() {
    var currentScrollPos = window.pageYOffset;
    if (prevScrollpos > currentScrollPos) {
      $(".navbar").css('top',"0");
    } else {
      $(".navbar").css('top',"-100px");
    }
    prevScrollpos = currentScrollPos;
  }


});
