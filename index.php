<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="shortcut icon" href="assets/news .png" type="image/x-icon">
    <style>
        nav {
            background-color: #0f1432;
        }

        .navbar-nav .nav-link {
            color: white !important;
        }
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
                    <li class="nav-item"><a class="nav-link" href="catogry.php?category=سياسة">سياسة</a></li>
                    <li class="nav-item"><a class="nav-link" href="catogry.php?category=اقتصاد">اقتصاد</a></li>
                    <li class="nav-item"><a class="nav-link" href="catogry.php?category=صحة">صحة</a></li>
                    <li class="nav-item"><a class="nav-link" href="catogry.php?category=رياضة">رياضة</a></li>
                </ul>
                <form class="d-flex me-auto" role="search" id="main-search-form">
                    <input class="form-control me-2" type="search" placeholder="بحث" aria-label="بحث"
                        style="direction: rtl;">
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
        <div class="row g-5 mb-5" id="main-random-news"></div>
        <div class="row mb-5" id="most-read-section"></div>
        <section class="row g-1 mb-5" id="political-news-section"></section>
        <section class="row g-2 mb-5" id="economic-news-section"></section>
        <section class="row g-2 mb-5" id="sport-news-section"></section>
        <section class="row g-2 mb-5" id="health-news-section"></section>
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
                    <h6 class="fw-bold">
                        روابط
                    </h6>
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
                        <span class="bg-dark rounded-circle d-inline-block"
                            style="width: 20px; height: 20px;"></span>
                        <span class="bg-dark rounded-circle d-inline-block"
                            style="width: 20px; height: 20px;"></span>
                        <span class="bg-dark rounded-circle d-inline-block"
                            style="width: 20px; height: 20px;"></span>
                        <span class="bg-dark rounded-circle d-inline-block"
                            style="width: 20px; height: 20px;"></span>
                        <span class="bg-dark rounded-circle d-inline-block"
                            style="width: 20px; height: 20px;"></span>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="JS/main.js"></script>
    <script src="JS/alerts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>