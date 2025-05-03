<?php
session_start();
require_once 'config.php';


if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$users = $conn->query("SELECT id, name, email, role FROM user_table ORDER BY id ASC");
?>

<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <title>لوحة تحكم المدير</title>
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
        <li class="nav-item"><a class="nav-link active" href="#">Admin Dashboard</a></li>
        <li class="nav-item"><a class="nav-link active" href="add_user.php">إضافة خبر</a></li>
        <li class="nav-item"><a class="nav-link text-danger" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">تسجيل الخروج</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-5">
  <?php if (isset($_SESSION['success_message'])): ?>
    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
      <?= $_SESSION['success_message']; unset($_SESSION['success_message']); ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="إغلاق"></button>
    </div>
  <?php endif; ?>

  <?php if (isset($_SESSION['error_message'])): ?>
    <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
      <?= $_SESSION['error_message']; unset($_SESSION['error_message']); ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="إغلاق"></button>
    </div>
  <?php endif; ?>

  <div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="text-primary mb-0">إدارة المستخدمين</h3>
    <a href="add_user.php" class="btn btn-success">+ إضافة مستخدم جديد</a>
  </div>

  <?php if ($users->num_rows > 0): ?>
    <table class="table table-bordered bg-white shadow">
      <thead class="table-dark">
        <tr>
          <th>#</th>
          <th>الاسم</th>
          <th>الإيميل</th>
          <th>الدور</th>
          <th>الإجراءات</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($user = $users->fetch_assoc()): ?>
          <tr>
            <td><?= $user['id'] ?></td>
            <td><?= htmlspecialchars($user['name']) ?></td>
            <td><?= htmlspecialchars($user['email']) ?></td>
            <td>
              <span class="badge bg-<?= $user['role'] === 'admin' ? 'danger' : ($user['role'] === 'editor' ? 'warning' : 'primary') ?>">
                <?= $user['role'] ?>
              </span>
            </td>
            <td>
              <a href="edit_user.php?id=<?= $user['id'] ?>" class="btn btn-sm btn-outline-primary">تعديل</a>
              <a href="delete_user.php?id=<?= $user['id'] ?>" class="btn btn-sm btn-outline-danger"
                 onclick="return confirm('هل أنت متأكد أنك تريد حذف هذا المستخدم؟');">حذف</a>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  <?php else: ?>
    <div class="alert alert-info">لا يوجد مستخدمين حالياً.</div>
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
