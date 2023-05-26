<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="">My Shop</a>
    <button style="border: none; box-shadow: none;" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="category">CATEGORY</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="product">PRODUCTS</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="order">ORDERS</a>
        </li>
      </ul>
      <div class="d-block d-md-flex align-items-center" role="search">
        <div class="me-4"><a href="profile">PROFILE</a></div>
        <div class="mt-4 mt-md-0">
          <?php if (isset($_SESSION['adminId'])) { ?>
            <button class="btn btn-primary" type="button" onclick="logout()">LOGOUT</button>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</nav>

<script>
  function logout() {
    $.ajax({
      method: "POST",
      url: 'api/v1/logout',
      data: {},
      success: function(response) {
        if (response.success) {
          sessionStorage.clear();
          setTimeout(() => {
            window.location.reload();
          }, 1000)
        } else {
          alert("Logout failed.");
        }
      },
      error: function(xhr, status, error) {
        console.error(xhr);
        alert("Something went wrong.");
      }
    });
  }
</script>