$(document).ready(function() {
  // Animasi pada elemen dengan kelas 'animate'
  $('.animate').hover(
    function() {
      $(this).addClass('animated');
    },
    function() {
      $(this).removeClass('animated');
    }
  );
});
