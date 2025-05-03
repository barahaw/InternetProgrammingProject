<?php
session_start();
require_once 'config.php';


$sql = "SELECT news_table.Id, news_table.Title, news_table.Date_Posted, news_table.Status,
               news_table.Image, news_table.Body, category_table.name AS category_name, user_table.name AS author_name
        FROM news_table
        LEFT JOIN category_table ON news_table.Category_Id = category_table.Id
        LEFT JOIN user_table ON news_table.Author_Id = user_table.Id
        ORDER BY news_table.Date_Posted DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <title>لوحة المحرر</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
  <a class="navbar-brand" href="#">
    <img src="assets/news .png" alt="" class="navbar-toggler-icon">
  </a>
  <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link active" href="#">Editor Dashboard</a></li>
        <li class="nav-item"><a class="nav-link text-danger" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">تسجيل الخروج</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-4">
  <?php if (isset($_SESSION['success_message'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <?= $_SESSION['success_message']; unset($_SESSION['success_message']); ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="إغلاق"></button>
    </div>
  <?php endif; ?>

  <h3 class="mb-4">كل الأخبار المقدمة من الكُتّاب</h3>

  <?php if ($result->num_rows > 0): ?>
    <div class="row">
      <?php while($row = $result->fetch_assoc()): ?>
        <div class="col-md-6 mb-4">
          <div class="card shadow-sm" data-bs-toggle="modal" data-bs-target="#modal<?= $row['Id']; ?>" style="cursor: pointer;">
            <?php if (!empty($row['Image'])): ?>
              <img src="uploads/<?= $row['Image']; ?>" class="card-img-top" style="height: 200px; object-fit: cover;">
            <?php endif; ?>
            <div class="card-body">
              <h5 class="card-title"><?= htmlspecialchars($row['Title']); ?></h5>
              <p class="card-text">
                <strong>القسم:</strong> <?= $row['category_name']; ?> <br>
                <strong>الكاتب:</strong> <?= $row['author_name']; ?> <br>
                <strong>الحالة:</strong> 
                <span class="badge bg-<?= $row['Status'] == 'approved' ? 'success' : ($row['Status'] == 'pending' ? 'warning' : 'secondary'); ?>">
                  <?= $row['Status']; ?>
                </span>
              </p>
              <p class="card-text"><small class="text-muted">بتاريخ: <?= $row['Date_Posted']; ?></small></p>
            </div>
          </div>
        </div>

        <div class="modal fade" id="modal<?= $row['Id']; ?>" tabindex="-1" aria-labelledby="modalLabel<?= $row['Id']; ?>" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modalLabel<?= $row['Id']; ?>">تفاصيل الخبر</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
              </div>
              <div class="modal-body">
                <?php if (!empty($row['Image'])): ?>
                  <img src="uploads/<?= $row['Image']; ?>" class="img-fluid mb-3" style="max-height: 300px; object-fit: cover;">
                <?php endif; ?>
                <h4><?= htmlspecialchars($row['Title']); ?></h4>
                <p class="text-muted">القسم: <?= $row['category_name']; ?> | الكاتب: <?= $row['author_name']; ?></p>
                <p><?= nl2br(htmlspecialchars($row['Body'])); ?></p>
              </div>
              <div class="modal-footer">
                <a href="approve_news.php?id=<?= $row['Id']; ?>" class="btn btn-success">موافقة</a>
                <a href="reject_news.php?id=<?= $row['Id']; ?>" class="btn btn-warning">رفض</a>
                <a href="delete_news.php?id=<?= $row['Id']; ?>" class="btn btn-danger" onclick="return confirm('هل أنت متأكد من الحذف؟')">حذف</a>
              </div>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  <?php else: ?>
    <div class="alert alert-info">لا يوجد أخبار حالياً.</div>
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
