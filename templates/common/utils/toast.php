<div class="toast-container position-fixed top-0 end-0 p-3">
  <div id="toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <strong id="toastTitle" class="me-auto"></strong>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div id="toastBody" class="toast-body">
    </div>
  </div>
</div>

<script>
function toast() {
    const toastComponent = document.getElementById('toast')
    const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastComponent)
    toastBootstrap.show()
}
</script>