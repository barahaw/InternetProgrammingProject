<?php
session_start();
require_once 'config.php';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$result = $conn->query("SELECT * FROM news_table WHERE id = $id");
$news = $result->fetch_assoc();

$categories = $conn->query("SELECT * FROM category_table");
?>

<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <title>تعديل الخبر</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">News CMS</a>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="author_dash.php">Dashboard</a></li>
        <li class="nav-item"><a class="nav-link text-danger" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">تسجيل الخروج</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-4">
  <?php if (isset($_SESSION['success_message'])): ?>
    <div class="alert alert-success text-center">
      <?= $_SESSION['success_message']; unset($_SESSION['success_message']); ?>
    </div>
  <?php endif; ?>

  

  <?php if (isset($_SESSION['error_message'])): ?>
    <div class="alert alert-danger text-center">
      <?= $_SESSION['error_message']; unset($_SESSION['error_message']); ?>
    </div>
  <?php endif; ?>
</div>

<div class="container mt-5">
  <div class="card shadow">
    <div class="card-header bg-primary text-white">
      <h4 class="mb-0">تعديل الخبر</h4>
    </div>
    <div class="card-body">
      <form action="update_news.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="Id" value="<?= $news['Id']; ?>">

        <div class="mb-3">
          <label class="form-label">العنوان</label>
          <input type="text" name="Title" class="form-control" value="<?= htmlspecialchars($news['Title']); ?>" required>
        </div>

        <div class="mb-3">
          <label class="form-label">المحتوى</label>
          <textarea name="body" class="form-control" rows="6" required><?= htmlspecialchars($news['Body']); ?></textarea>
        </div>

        <div class="mb-3">
          <label class="form-label">الصورة (اختياري)</label><br>
          <?php if (!empty($news['image'])): ?>
            <img src="uploads/<?= $news['image']; ?>" width="150" class="mb-2"><br>
          <?php endif; ?>
          <input type="file" name="image" class="form-control">
        </div>

        <div class="mb-3">
          <label class="form-label">القسم</label>
          <select name="category_id" class="form-select" required>
            <?php while ($cat = $categories->fetch_assoc()): ?>
              <option value="<?= $cat['Id']; ?>" <?= ($cat['Id'] == $news['Category_Id']) ? 'selected' : ''; ?>>
                <?= $cat['Name']; ?>
              </option>
            <?php endwhile; ?>
          </select>
        </div>

        <button type="submit" class="btn btn-success">تحديث</button>
        <a href="author_dash.php" class="btn btn-secondary">إلغاء</a>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-warning text-dark">
        <h5 class="modal-title" id="logoutModalLabel">
          <img src="https://cdn-icons-png.flaticon.com/512/1828/1828843.png" width="24" class="me-2">
          تأكيد تسجيل الخروج
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
      </div>
      <div class="modal-body text-center">
        هل أنت متأكد أنك تريد تسجيل الخروج؟
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
        <a href="logout.php" class="btn btn-danger">تأكيد الخروج</a>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  const alerts = document.querySelectorAll('.alert');
  alerts.forEach(alert => {
    setTimeout(() => {
      const bsAlert = new bootstrap.Alert(alert);
      bsAlert.close();
    }, 10000); 
  });
  
  </body>
</html>