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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function renderCategoryContent(newsArr) {
            if (!Array.isArray(newsArr) || newsArr.length === 0) {
                return '<div class="alert alert-info">لا توجد أخبار في هذا القسم حالياً.</div>';
            }
            let mainHtml = '';
            if (newsArr[0]) {
                mainHtml += `
                    <div class="col-lg-8">
                        <div class="card border-0">
                            <img class="card-img-top" src="assets/${newsArr[0].Image}" alt="${newsArr[0].Title}">
                            <div class="card-body">
                                <h6 class="text-muted">${newsArr[0].category || ''}</h6>
                                <h5 class="fw-bold">${newsArr[0].Title}</h5>
                                <p class="text-secondary">${newsArr[0].excerpt || ''}</p>
                            </div>
                        </div>
                `;
                for (let i = 1; i <= 2; i++) {
                    if (newsArr[i]) {
                        mainHtml += `
                            <div class="mb-4 d-flex align-items-start gap-3">
                                <img src="assets/${newsArr[i].Image}" class="img-fluid" style="width: 150px; height: auto;">
                                <div style="max-width: 500px;">
                                    <h6 class="fw-bold mb-1 text-muted">${newsArr[i].category || ''}</h6>
                                    <h5 class="fw-bold mb-2">${newsArr[i].Title}</h5>
                                    <p class="text-secondary mb-0">${newsArr[i].excerpt || ''}</p>
                                </div>
                            </div>
                        `;
                    }
                }
                mainHtml += '</div>';
            }
            let rightHtml = '<div class="col-lg-4">';
            if (newsArr[0]) {
                rightHtml += `
                    <div class="card border-0 mb-3">
                        <img class="card-img-top" src="assets/${newsArr[0].Image}" alt="${newsArr[0].Title}">
                        <div class="card-body">
                            <h6 class="text-muted">${newsArr[0].category || ''}</h6>
                            <h5 class="fw-bold">${newsArr[0].Title}</h5>
                            <p class="text-muted">${newsArr[0].excerpt || ''}</p>
                        </div>
                    </div>
                `;
            }
            for (let i = 3; i < newsArr.length && i < 5; i++) {
                rightHtml += `
                    <div class="card mb-3 border-0">
                        <div class="row g-0">
                            <div class="col-4">
                                <img src="assets/${newsArr[i].Image}" class="img-fluid rounded-start" alt="news-feed">
                            </div>
                            <div class="col-8">
                                <div class="card-body">
                                    <p class="text-muted mb-1">${newsArr[i].category || ''}</p>
                                    <h6 class="card-title">${newsArr[i].Title}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            }
            rightHtml += `
                <div class="card border-0">
                    <img src="assets/ad.png" class="card-img-top" alt="advertise">
                </div>
            </div>`;
            return mainHtml + rightHtml;
        }
        function loadCategoryContent(category) {
            const content = document.getElementById('category-content');
            const title = document.getElementById('category-title');
            title.textContent = category;
            content.innerHTML = '<div class="loading-spinner"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>';
            fetch(`category_api.php?category=${encodeURIComponent(category)}`)
                .then(res => res.json())
                .then(data => {
                    content.innerHTML = renderCategoryContent(data);
                });
        }
        document.querySelectorAll('.category-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const category = this.getAttribute('data-category');
                loadCategoryContent(category);
            });
        });
        const searchForm = document.querySelector('form[role="search"]');
        if (searchForm) {
            searchForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const q = this.querySelector('input[type="search"]').value.trim();
                if (!q) return;
                const url = new URL(window.location.href);
                url.searchParams.set('q', q);
                url.searchParams.delete('category');
                window.location.href = url.toString();
            });
        }
        window.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const q = urlParams.get('q');
            const cat = urlParams.get('category');
            if (q) {
                const content = document.getElementById('category-content');
                const title = document.getElementById('category-title');
                title.textContent = 'نتائج البحث';
                content.innerHTML = '<div class="loading-spinner"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>';
                fetch(`search_api.php?q=${encodeURIComponent(q)}`)
                    .then(res => res.json())
                    .then(data => {
                        content.innerHTML = renderCategoryContent(data);
                    });
            } else if (cat) {
                loadCategoryContent(cat);
            }
        });
    </script>
</body>
</html>