<?php
require_once 'includes/auth.php';
require_once __DIR__ . '/../data/studios.php'; // $studios array
require_once 'includes/header.php';
?>

<div class="container my-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Manage Studios</h1>
    <a href="studio.php" class="btn btn-primary">+ Add Studio</a>
  </div>

  <?php if (empty($studios)): ?>
    <div class="alert alert-info">No studios yet. Add one to begin.</div>
  <?php else: ?>
    <div class="row row-cols-1 row-cols-md-3 g-3">
      <?php foreach ($studios as $studio): ?>
        <div class="col">
          <div class="card h-100">
            <?php if (!empty($studio['logo'])): ?>
              <img src="../images/<?= htmlspecialchars($studio['logo']) ?>" class="card-img-top" alt="">
            <?php endif; ?>
            <div class="card-body">
              <h5 class="card-title"><?= htmlspecialchars($studio['name']) ?></h5>
              <a href="studio.php?id=<?= urlencode($studio['id']) ?>" class="btn btn-sm btn-outline-secondary">Edit</a>
              <form method="POST" action="studio_delete.php" class="d-inline" onsubmit="return confirm('Delete this studio?');">
                <input type="hidden" name="id" value="<?= htmlspecialchars($studio['id']) ?>">
                <button class="btn btn-sm btn-outline-danger">Delete</button>
              </form>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>

<?php require_once 'includes/footer.php'; ?>