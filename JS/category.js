function renderCategoryContent(newsArr) {
  if (!Array.isArray(newsArr) || newsArr.length === 0) {
    return '<div class="alert alert-info">لا توجد أخبار في هذا القسم حالياً.</div>';
  }
  newsArr = newsArr.map((item) => {
    let id = item.id !== undefined ? item.id : item.Id;
    return { ...item, id };
  });
  let mainHtml = "";
  if (newsArr[0]) {
    mainHtml += `
            <div class="col-lg-8">
                <div class="card border-0">
                    <a href="details.php?id=${
                      newsArr[0].id
                    }"><img class="card-img-top" src="assets/${
      newsArr[0].Image
    }" alt="${newsArr[0].Title}"></a>
                    <div class="card-body">
                        <h6 class="text-muted">${newsArr[0].category || ""}</h6>
                        <a href="details.php?id=${
                          newsArr[0].id
                        }" class="text-decoration-none text-dark"><h5 class="fw-bold">${
      newsArr[0].Title
    }</h5></a>
                        <p class="text-secondary">${
                          newsArr[0].excerpt || ""
                        }</p>
                    </div>
                </div>
        `;
    for (let i = 1; i <= 2; i++) {
      if (newsArr[i]) {
        mainHtml += `
                    <div class="mb-4 d-flex align-items-start gap-3">
                        <a href="details.php?id=${
                          newsArr[i].id
                        }"><img src="assets/${
          newsArr[i].Image
        }" class="img-fluid" style="width: 150px; height: auto;"></a>
                        <div style="max-width: 500px;">
                            <h6 class="fw-bold mb-1 text-muted">${
                              newsArr[i].category || ""
                            }</h6>
                            <a href="details.php?id=${
                              newsArr[i].id
                            }" class="text-decoration-none text-dark"><h5 class="fw-bold mb-2">${
          newsArr[i].Title
        }</h5></a>
                            <p class="text-secondary mb-0">${
                              newsArr[i].excerpt || ""
                            }</p>
                        </div>
                    </div>
                `;
      }
    }
    mainHtml += "</div>";
  }
  let rightHtml = '<div class="col-lg-4">';
  if (newsArr[0]) {
    rightHtml += `
            <div class="card border-0 mb-3">
                <a href="details.php?id=${
                  newsArr[0].id
                }"><img class="card-img-top" src="assets/${
      newsArr[0].Image
    }" alt="${newsArr[0].Title}"></a>
                <div class="card-body">
                    <h6 class="text-muted">${newsArr[0].category || ""}</h6>
                    <a href="details.php?id=${
                      newsArr[0].id
                    }" class="text-decoration-none text-dark"><h5 class="fw-bold">${
      newsArr[0].Title
    }</h5></a>
                    <p class="text-muted">${newsArr[0].excerpt || ""}</p>
                </div>
            </div>
        `;
  }
  for (let i = 3; i < newsArr.length && i < 5; i++) {
    rightHtml += `
            <div class="card mb-3 border-0">
                <div class="row g-0">
                    <div class="col-4">
                        <a href="details.php?id=${
                          newsArr[i].id
                        }"><img src="assets/${
      newsArr[i].Image
    }" class="img-fluid rounded-start" alt="news-feed"></a>
                    </div>
                    <div class="col-8">
                        <div class="card-body">
                            <p class="text-muted mb-1">${
                              newsArr[i].category || ""
                            }</p>
                            <a href="details.php?id=${
                              newsArr[i].id
                            }" class="text-decoration-none text-dark"><h6 class="card-title">${
      newsArr[i].Title
    }</h6></a>
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
  const content = document.getElementById("category-content");
  const title = document.getElementById("category-title");
  title.textContent = category;
  content.innerHTML =
    '<div class="loading-spinner"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>';
  fetch(`category_api.php?category=${encodeURIComponent(category)}`)
    .then((res) => res.json())
    .then((data) => {
      content.innerHTML = renderCategoryContent(data);
    });
}

document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll(".category-link").forEach((link) => {
    link.addEventListener("click", function (e) {
      e.preventDefault();
      const category = this.getAttribute("data-category");
      loadCategoryContent(category);
    });
  });
  const searchForm = document.querySelector('form[role="search"]');
  if (searchForm) {
    searchForm.addEventListener("submit", function (e) {
      e.preventDefault();
      const q = this.querySelector('input[type="search"]').value.trim();
      if (!q) return;
      const url = new URL(window.location.href);
      url.searchParams.set("q", q);
      url.searchParams.delete("category");
      window.location.href = url.toString();
    });
  }
  const urlParams = new URLSearchParams(window.location.search);
  const q = urlParams.get("q");
  const cat = urlParams.get("category");
  if (q) {
    const content = document.getElementById("category-content");
    const title = document.getElementById("category-title");
    title.textContent = "نتائج البحث";
    content.innerHTML =
      '<div class="loading-spinner"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>';
    fetch(`search_api.php?q=${encodeURIComponent(q)}`)
      .then((res) => res.json())
      .then((data) => {
        content.innerHTML = renderCategoryContent(data);
      });
  } else if (cat) {
    loadCategoryContent(cat);
  }
});
