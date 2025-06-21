<?php
// admin/includes/footer.php
?>
<footer class="bg-light text-center text-muted mt-5 py-4">
  <div class="container">
    <small>&copy; <?= date('Y') ?> Movie Database Admin Panel</small>
  </div>
</footer>

<style>
  th[data-sort]::after {
    content: " ▼";
    font-size: 0.75em;
    padding-left: 5px;
  }

  th[data-sort].asc::after {
    content: " ▲";
  }
</style>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>