<?php
session_start();
require_once 'config.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$author_id = isset($_SESSION['author_id']) ? $_SESSION['author_id'] : 0;

$sql = "SELECT news_table.id, news_table.title, news_table.date_posted, news_table.status, news_table.image, category_table.name AS category_name 
        FROM news_table
        LEFT JOIN category_table ON news_table.category_id = category_table.id
        WHERE news_table.author_id = $author_id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <title>لوحة الكاتب</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">News CMS</a>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link active" href="author_dash.php">الرئيسية</a></li>
        <li class="nav-item"><a class="nav-link" href="add_news.php">إضافة خبر</a></li>
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

<div class="container mt-3">
  <h3 class="mb-4">أخباري</h3>

  <?php if ($result->num_rows > 0): ?>
    <div class="row">
      <?php while ($row = $result->fetch_assoc()): ?>
        <div class="col-md-6 mb-4">
          <div class="card shadow-sm">
            <?php if (!empty($row['image'])): ?>
              <img src="uploads/<?= $row['image']; ?>" class="card-img-top" style="height: 200px; object-fit: cover;">
            <?php endif; ?>
            <div class="card-body">
              <h5 class="card-title"><?= htmlspecialchars($row['title']); ?></h5>
              <p class="card-text text-muted">
                القسم: <?= $row['category_name']; ?> |
                الحالة:
                <span class="badge bg-<?= $row['status'] == 'approved' ? 'success' : 'warning'; ?>">
                  <?= $row['status']; ?>
                </span>
              </p>
              <p class="card-text"><small class="text-muted">بتاريخ: <?= $row['date_posted']; ?></small></p>
              <div class="d-flex justify-content-between">
                <a href="edit_news.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-outline-primary">تعديل</a>
                <a href="delete_news.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('هل أنت متأكد؟')">حذف</a>
              </div>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  <?php else: ?>
    <div class="alert alert-info">لا يوجد أخبار مضافة.</div>
  <?php endif; ?>
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
</body>
</html>
