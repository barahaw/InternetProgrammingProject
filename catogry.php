<?php
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="shortcut icon" href="assets/news .png" type="image/x-icon">
    <title>catogry</title>
    <style>
        nav { background-color: #0f1432; }
        .navbar-nav .nav-link { color: white !important; }
        .fade-in { animation: fadeIn 0.5s; }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        .loading-spinner { display: flex; justify-content: center; align-items: center; min-height: 200px; }
    </style>
</head>
<body>
    <nav class="navbar d-flex justify-content-between navbar-expand-lg ">
        <div class=" container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03"
                aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#">
                <img src="assets/news .png" alt="" class="navbar-toggler-icon">
            </a>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                <ul class="navbar-nav mb-2 mb-lg-0 text-white ">
                    <li class="nav-item "><a class="nav-link active " href="index.php">الرئيسية</a></li>
                    <li class="nav-item "><a class="nav-link active category-link" data-category="سياسة" href="#">سياسة</a></li>
                    <li class="nav-item"><a class="nav-link category-link" data-category="اقتصاد" href="#">اقتصاد</a></li>
                    <li class="nav-item"><a class="nav-link category-link" data-category="صحة" href="#">صحة</a></li>
                    <li class="nav-item"><a class="nav-link category-link" data-category="رياضة" href="#">رياضة</a></li>
                </ul>
                <form class="d-flex me-auto" role="search">
                    <input class="form-control me-2" type="search" placeholder="بحث" aria-label="بحث" style="direction: rtl;">
                    <button class="btn btn-outline-light" type="submit"><i class="bi bi-search"></i></button>
                </form>
            </div>
            <div class="d-flex align-items-center">
                <div class="d-none d-lg-flex align-items-center px-2">
                    <div style="border-left: 1px solid #808080; height: 25px;"></div>
                </div>
                <div class="d-none d-lg-flex align-items-center px-2">
                    <div style="border-left: 1px solid #808080; height: 25px;"></div>
                </div>
                <div class="d-flex flex-column align-items-center text-center ms-3">
                    <div class="text-white">
                        <i class="bi bi-cloud-moon-fill"></i> 8&deg;C
                    </div>
                    <div class="text-white">الدوحة</div>
                </div>
            </div>
        </div>
    </nav>
    <main class="container mt-4">
        <div class="row">
            <div class="row">
                <div class="col-12 border-bottom">
                    <h6>
                        <span class="border-bottom border-4 border-primary pb-1 container" id="category-title">
                            رياضة
                        </span>
                    </h6>
                </div>
            </div>
            <section class="row mt-4" id="category-content">
            </section>
        </div>
    </main>
    <footer class=" bg-light py-4">
        <div class="container">
            <div class="row text-center text-md-start">
                <div class="col-md-3 text-center text-md-end">
                    <img src="assets/news .png" alt="logo" style="max-width: 80px;">
                    <p class="mt-2 text-muted">
                        تغطية إخبارية شاملة ومتنوعة للوسائط للأحداث الجارية والعاجلة، وتفتح الوصول إلى
                        شبكة متنوعة
                        من البرامج السياسية والاجتماعية.
                    </p>
                </div>
                <div class="col-md-3 text-center text-md-start">
                    <h6 class="fw-bold">روابط</h6>
                    <ul class="list-unstyled fw-bold">
                        <li>سياسة</li>
                        <li>اقتصاد</li>
                        <li>فن وثقافة</li>
                        <li>رياضة</li>
                        <li>منوعات</li>
                    </ul>
                </div>
                <div class="col-md-3 text-center text-md-start">
                    <h6 class="fw-bold">عن الموقع</h6>
                    <ul class="list-unstyled fw-bold">
                        <li>من نحن </li>
                        <li>اعلن معنا </li>
                    </ul>
                </div>
                <div class="col-md-3 d-flex flex-column align-items-center">
                    <h6 class="fw-bold">اتصل بنا</h6>
                    <div class="d-flex gap-2">
                        <span class="bg-dark rounded-circle d-inline-block" style="width: 20px; height: 20px;"></span>
                        <span class="bg-dark rounded-circle d-inline-block" style="width: 20px; height: 20px;"></span>
                        <span class="bg-dark rounded-circle d-inline-block" style="width: 20px; height: 20px;"></span>
                        <span class="bg-dark rounded-circle d-inline-block" style="width: 20px; height: 20px;"></span>
                        <span class="bg-dark rounded-circle d-inline-block" style="width: 20px; height: 20px;"></span>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="JS/category.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>