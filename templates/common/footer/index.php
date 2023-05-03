<footer class="footer">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h3>About Us</h3>
        <p>We are a computer accessories shop that offers a wide range of products to our customers. Our goal is to provide the best quality products at affordable prices.</p>
      </div>
      <div class="col-md-3">
        <h3>Our Services</h3>
        <ul class="list-unstyled">
          <li><a href="#">Home</a></li>
          <li><a href="#">Products</a></li>
        </ul>
      </div>
      <div class="col-md-3">
        <h3>Contact Us</h3>
        <p>123 Main Street<br>Anytown, USA<br>Phone: (123) 456-7890<br>Email: info@computeraccessoriesshop.com</p>
      </div>
    </div>
  </div>
  <div class="container">
    <button class="btn btn-primary-outline" id="scroll-to-top">Top</button>
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