<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="home">My Shop</a>
    <button style="border: none; box-shadow: none;" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="home">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="products">Products</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" id="searchInput" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-primary" type="button" onclick="search()">Search</button>
      </form>
      <div class="nav-item my-2 my-sm-0 mx-0 mx-sm-2">
        <?php echo !isset($_SESSION['userId']) ? "<a class='nav-link' aria-current='page' href='login'>Login</a>" : "" ?>
        <?php echo isset($_SESSION['userId']) ? "<a class='nav-link text-danger' aria-current='page' onclick='logout()'>Logout</a>" : "" ?>
      </div>
    </div>
  </div>
</nav>

<script>
  function search() {
    const searchStr = $('#searchInput').val();

    window.location.href = `products?search=${searchStr}`;
  }

  function logout() {
    $.ajax({
      method: "POST",
      url: 'api/v1/logout',
      data: {},
      success: function(response) {
        if (response.success) {
          sessionStorage.clear();
          setTimeout(() => {
            window.location.replace('login');
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