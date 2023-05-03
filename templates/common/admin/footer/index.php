<footer class="footer">
  <div class="container">
   <p>Admin Panel</p>
  </div>
  <div class="container">
    <button class="btn btn-outline-primary" id="scroll-to-top">Top</button>
  </div>
</footer>

<script>
  $(document).ready(function() {
    $(window).scroll(function() {
      if ($(this).scrollTop() > 200) {
        $('#scroll-to-top').fadeIn();
      } else {
        $('#scroll-to-top').fadeOut();
      }
    });

    $('#scroll-to-top').click(function() {
      $('html, body').animate({
        scrollTop: 0
      }, 500);
      return false;
    });
  });
</script>