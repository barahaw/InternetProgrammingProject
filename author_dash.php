<?php
session_start();
require_once 'config.php';



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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .sidebar {
      position: fixed;
      top: 0;
      right: 0;
      height: 100%;
      width: 250px;
      background-color: #343a40;
      color: white;
      padding-top: 60px;
      transition: right 0.3s;
      z-index: 1050;
      overflow-y: auto;
    }
    .sidebar.collapsed {
      right: -250px;
    }
    .sidebar a {
      color: white;
      padding: 10px 20px;
      display: block;
      text-decoration: none;
    }
    .sidebar a:hover {
      background-color: #495057;
    }
    .sidebar .close-sidebar {
      display: block;
      text-align: center;
      background-color: #dc3545;
      color: white;
      margin: 15px;
      padding: 10px;
      border-radius: 5px;
      text-decoration: none;
    }
    .sidebar .close-sidebar:hover {
      background-color: #bb2d3b;
    }
  </style>
</head>
<body class="bg-light" onclick="autoCollapseSidebar(event)">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
  <a class="navbar-brand" href="#">
    <img src="assets/news .png" alt="" class="navbar-toggler-icon">
  </a>
  <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link active" href="author_dash.php">dashbord</a></li>
        <li class="nav-item"><a class="nav-link" href="add_news.php">إضافة خبر</a></li>
        <li class="nav-item"><a class="nav-link" href="#" onclick="toggleSidebar(event)">مقالاتي</a></li>
        <li class="nav-item"><a class="nav-link text-danger" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">تسجيل الخروج</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="sidebar collapsed" id="sidebar">
  <h5 class="text-center">مقالاتي</h5>
  <hr>
  <?php 
  $sideSql = "SELECT id, title, status FROM news_table WHERE author_id = $author_id ORDER BY date_posted DESC";
  $sideRes = $conn->query($sideSql);
  while ($row = $sideRes->fetch_assoc()): ?>
    <a href="edit_news.php?id=<?= $row['id'] ?>">
      <?= htmlspecialchars($row['title']) ?>
      <span class="badge bg-<?= $row['status'] == 'approved' ? 'success' : 'warning' ?> float-end">
        <?= $row['status'] == 'approved' ? 'تمت الموافقة' : 'بانتظار' ?>
      </span>
    </a>
  <?php endwhile; ?>
  <a href="#" class="close-sidebar" onclick="toggleSidebar(event)">إغلاق الشريط</a>
</div>

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
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="mb-0">أخباري</h3>
    <a href="add_news.php" class="btn btn-success">+ إضافة مقال</a>
  </div>

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

<script>
  function toggleSidebar(event) {
    event.stopPropagation();
    document.getElementById('sidebar').classList.toggle('collapsed');
  }

  function autoCollapseSidebar(event) {
    const sidebar = document.getElementById('sidebar');
    if (!sidebar.classList.contains('collapsed') && !sidebar.contains(event.target)) {
      sidebar.classList.add('collapsed');
    }
  }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
