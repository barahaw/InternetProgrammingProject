<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$users = $conn->query("SELECT id, name, email, role FROM user_table ORDER BY id ASC");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ad_action'])) {
    if ($_POST['ad_action'] === 'save_ad') {
        $ad_text = trim($_POST['ad_text']);
        $ad_id = isset($_POST['ad_id']) ? intval($_POST['ad_id']) : 0;
        $ad_image_path_to_store = null;
        $new_image_uploaded = false;
        $upload_dir = 'assets/ads/';

        if (!is_dir($upload_dir)) {
            if (!mkdir($upload_dir, 0755, true)) {
                $_SESSION['error_message'] = 'فشل في إنشاء مجلد الرفع. تحقق من الأذونات.';
                header('Location: admin_dash.php#ads-management');
                exit;
            }
        }

        if (isset($_FILES['ad_image_file']) && $_FILES['ad_image_file']['error'] == UPLOAD_ERR_OK && $_FILES['ad_image_file']['size'] > 0) {
            $image_filename_parts = explode('.', $_FILES['ad_image_file']['name']);
            $image_extension = strtolower(end($image_filename_parts));
            $image_basename = uniqid('ad_', true) . '.' . $image_extension;
            $target_file_path = $upload_dir . $image_basename;

            $allowed_types = ['jpg' => 'image/jpeg', 'png' => 'image/png', 'gif' => 'image/gif', 'jpeg' => 'image/jpeg'];
            $file_mime_type = mime_content_type($_FILES['ad_image_file']['tmp_name']);

            if (!in_array($image_extension, array_keys($allowed_types)) || !in_array($file_mime_type, $allowed_types)) {
                $_SESSION['error_message'] = 'نوع الملف غير صالح. الأنواع المسموح بها: JPG, PNG, GIF.';
            } elseif ($_FILES['ad_image_file']['size'] > 2 * 1024 * 1024) {
                $_SESSION['error_message'] = 'حجم الملف كبير جداً. الحد الأقصى 2 ميغابايت.';
            } elseif (move_uploaded_file($_FILES['ad_image_file']['tmp_name'], $target_file_path)) {
                $ad_image_path_to_store = $target_file_path;
                $new_image_uploaded = true;
            } else {
                $_SESSION['error_message'] = 'حدث خطأ أثناء تحميل الصورة.';
            }
        }

        if (empty($ad_text)) {
            $_SESSION['error_message'] = 'نص الإعلان مطلوب.';
        } elseif ($ad_id == 0 && !$new_image_uploaded && !isset($_SESSION['error_message'])) {
            $_SESSION['error_message'] = 'صورة الإعلان مطلوبة عند إضافة إعلان جديد.';
        } elseif (isset($_SESSION['error_message'])) {
        } else {
            if ($ad_id > 0) {
                $current_image_path = null;
                if ($new_image_uploaded) {
                    $stmt_old_img = $conn->prepare("SELECT image FROM ads WHERE id = ?");
                    $stmt_old_img->bind_param("i", $ad_id);
                    $stmt_old_img->execute();
                    $result_old_img = $stmt_old_img->get_result();
                    if ($old_ad = $result_old_img->fetch_assoc()) {
                        $current_image_path = $old_ad['image'];
                    }
                    $stmt_old_img->close();

                    $stmt = $conn->prepare("UPDATE ads SET ad_text=?, image=? WHERE id=?");
                    $stmt->bind_param("ssi", $ad_text, $ad_image_path_to_store, $ad_id);
                } else {
                    $stmt = $conn->prepare("UPDATE ads SET ad_text=? WHERE id=?");
                    $stmt->bind_param("si", $ad_text, $ad_id);
                }
                
                if (isset($stmt)) {
                    if ($stmt->execute()) {
                        $_SESSION['success_message'] = 'تم تحديث الإعلان بنجاح.';
                        if ($new_image_uploaded && !empty($current_image_path) && file_exists($current_image_path) && $current_image_path !== $ad_image_path_to_store) {
                            unlink($current_image_path);
                        }
                    } else {
                        $_SESSION['error_message'] = 'خطأ في تحديث الإعلان: ' . $conn->error;
                        if ($new_image_uploaded && file_exists($ad_image_path_to_store)) {
                            unlink($ad_image_path_to_store);
                        }
                    }
                    $stmt->close();
                }
            } else {
                if ($new_image_uploaded) { 
                    $stmt = $conn->prepare("INSERT INTO ads (ad_text, image) VALUES (?, ?)");
                    $stmt->bind_param("ss", $ad_text, $ad_image_path_to_store);
                    if ($stmt->execute()) {
                        $_SESSION['success_message'] = 'تم إضافة الإعلان بنجاح.';
                    } else {
                        $_SESSION['error_message'] = 'خطأ في إضافة الإعلان: ' . $conn->error;
                        if (file_exists($ad_image_path_to_store)) {
                            unlink($ad_image_path_to_store);
                        }
                    }
                    $stmt->close();
                } else if (!isset($_SESSION['error_message'])) {
                     $_SESSION['error_message'] = 'خطأ غير متوقع: صورة الإعلان مفقودة للإعلان الجديد.';
                }
            }
        }
    }
    header('Location: admin_dash.php#ads-management');
    exit;
}

if (isset($_GET['delete_ad'])) {
    $ad_id_to_delete = intval($_GET['delete_ad']);
    
    $stmt_select = $conn->prepare("SELECT image FROM ads WHERE id = ?");
    $stmt_select->bind_param("i", $ad_id_to_delete);
    $stmt_select->execute();
    $result = $stmt_select->get_result();
    $ad_data = $result->fetch_assoc();
    $stmt_select->close();

    $stmt = $conn->prepare("DELETE FROM ads WHERE id=?");
    $stmt->bind_param("i", $ad_id_to_delete);
    if ($stmt->execute()) {
        $_SESSION['success_message'] = 'تم حذف الإعلان بنجاح.';
        if ($ad_data && !empty($ad_data['image']) && file_exists($ad_data['image'])) {
            unlink($ad_data['image']);
        }
    } else {
        $_SESSION['error_message'] = 'خطأ في حذف الإعلان: ' . $conn->error;
    }
    $stmt->close();
    header('Location: admin_dash.php#ads-management');
    exit;
}

$ads = $conn->query("SELECT id, ad_text, image FROM ads ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <title>لوحة تحكم المدير</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
  <div class="container-fluid">
  <a class="navbar-brand" href="#">
    <img src="assets/news .png" alt="" class="navbar-toggler-icon">
  </a>
  <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link active" href="#">Admin Dashboard</a></li>
        <li class="nav-item"><a class="nav-link text-danger" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">تسجيل الخروج</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-5">
  <?php if (isset($_SESSION['success_message'])): ?>
    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
      <?= htmlspecialchars($_SESSION['success_message']); unset($_SESSION['success_message']); ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="إغلاق"></button>
    </div>
  <?php endif; ?>

  <?php if (isset($_SESSION['error_message'])): ?>
    <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
      <?= htmlspecialchars($_SESSION['error_message']); unset($_SESSION['error_message']); ?>
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
            <td><?= htmlspecialchars($user['id']) ?></td>
            <td><?= htmlspecialchars($user['name']) ?></td>
            <td><?= htmlspecialchars($user['email']) ?></td>
            <td>
              <span class="badge bg-<?= htmlspecialchars($user['role'] === 'admin' ? 'danger' : ($user['role'] === 'editor' ? 'warning' : 'primary')) ?>">
                <?= htmlspecialchars($user['role']) ?>
              </span>
            </td>
            <td>
              <a href="edit_user.php?id=<?= htmlspecialchars($user['id']) ?>" class="btn btn-sm btn-outline-primary">تعديل</a>
              <a href="delete_user.php?id=<?= htmlspecialchars($user['id']) ?>" class="btn btn-sm btn-outline-danger"
                 onclick="return confirm('هل أنت متأكد أنك تريد حذف هذا المستخدم؟');">حذف</a>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  <?php else: ?>
    <div class="alert alert-info">لا يوجد مستخدمين حالياً.</div>
  <?php endif; ?>

  <hr class="my-5">

  <div id="ads-management" class="mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="text-primary mb-0">إدارة الإعلانات</h3>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">إضافة / تعديل إعلان</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="admin_dash.php#ads-management" enctype="multipart/form-data">
                <input type="hidden" name="ad_action" value="save_ad">
                <input type="hidden" name="ad_id" id="ad_id_field" value="0">
                <div class="mb-3">
                    <label for="ad_text" class="form-label">نص الإعلان (وصف قصير):</label>
                    <input type="text" name="ad_text" id="ad_text_field" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="ad_image_file_field" class="form-label">صورة الإعلان:</label>
                    <input type="file" name="ad_image_file" id="ad_image_file_field" class="form-control">
                    <div id="current_ad_image_preview" class="mt-2"></div>
                    <small class="form-text text-muted">اترك هذا الحقل فارغًا إذا كنت لا ترغب في تغيير الصورة الحالية عند التعديل. (الحد الأقصى 2MB, الأنواع المسموحة: JPG, PNG, GIF)</small>
                </div>
                <button type="submit" class="btn btn-success">حفظ الإعلان</button>
                <button type="button" class="btn btn-secondary" onclick="clearAdForm()">مسح النموذج</button>
            </form>
        </div>
    </div>

    <h4 class="text-secondary mb-3">الإعلانات الحالية</h4>
    <?php if ($ads && $ads->num_rows > 0): ?>
        <table class="table table-bordered bg-white shadow">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>النص</th>
                    <th>صورة (رابط)</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                <?php while($ad = $ads->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($ad['id']) ?></td>
                        <td><?= htmlspecialchars($ad['ad_text']) ?></td>
                        <td>
                            <?php if (!empty($ad['image']) && file_exists($ad['image'])): ?>
                                <img src="<?= htmlspecialchars($ad['image']) ?>?t=<?= time() ?>" alt="<?= htmlspecialchars($ad['ad_text']) ?>" style="max-width: 100px; max-height: 50px; border:1px solid #ddd;">
                            <?php else: ?>
                                <small>لا توجد صورة</small>
                            <?php endif; ?>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary" onclick="editAd(<?= htmlspecialchars($ad['id']) ?>, '<?= htmlspecialchars(addslashes($ad['ad_text']), ENT_QUOTES) ?>', '<?= !empty($ad['image']) ? htmlspecialchars(addslashes($ad['image']), ENT_QUOTES) : '' ?>')">تعديل</button>
                            <a href="admin_dash.php?delete_ad=<?= htmlspecialchars($ad['id']) ?>#ads-management" class="btn btn-sm btn-outline-danger"
                               onclick="return confirm('هل أنت متأكد أنك تريد حذف هذا الإعلان؟');">حذف</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info">لا توجد إعلانات حالياً.</div>
    <?php endif; ?>
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
    function editAd(id, text, currentImageUrl) {
        document.getElementById('ad_id_field').value = id;
        document.getElementById('ad_text_field').value = text;
        
        const previewDiv = document.getElementById('current_ad_image_preview');
        const fileInput = document.getElementById('ad_image_file_field');
        
        fileInput.value = '';

        if (currentImageUrl) {
            previewDiv.innerHTML = '<p class="mb-1">الصورة الحالية:</p><img src="' + currentImageUrl + '?t=' + new Date().getTime() + '" alt="Ad Image" style="max-width: 100px; max-height: 100px; display: block; margin-bottom: 5px; border:1px solid #ddd;"> <small>' + currentImageUrl.split('/').pop() + '</small>';
        } else {
            previewDiv.innerHTML = '<p>لا توجد صورة حالية.</p>';
        }
        
        window.location.hash = '#ads-management';
        document.getElementById('ad_text_field').focus();
    }

    function clearAdForm() {
        document.getElementById('ad_id_field').value = '0';
        document.getElementById('ad_text_field').value = '';
        document.getElementById('ad_image_file_field').value = '';
        document.getElementById('current_ad_image_preview').innerHTML = '';
        document.getElementById('ad_text_field').focus();
    }

    if(window.location.hash === '#ads-management') {
        const el = document.getElementById('ads-management');
        if (el) {
            el.scrollIntoView({behavior: 'smooth'});
        }
    }
</script>
</body>
</html>
