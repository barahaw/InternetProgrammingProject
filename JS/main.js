function renderMainRandomNews(newsArr) {
  if (!Array.isArray(newsArr) || newsArr.length === 0) {
    return '<div class="alert alert-info">لا توجد أخبار متاحة حالياً.</div>';
  }
  let html = "";
  if (newsArr[0]) {
    html += `
        <div class="col-md-4">
            <div class="card bg-dark text-white">
                <a href="details.php?id=${newsArr[0].id}"><img src="assets/${
      newsArr[0].image
    }" class="card-img-top" alt="${
      newsArr[0].title
    }" style="aspect-ratio:16/14;object-fit:cover;"></a>
                <div class="card-body">
                    <h6 class="card-title text-secondary">${
                      newsArr[0].category || ""
                    }</h6>
                    <a href="details.php?id=${
                      newsArr[0].id
                    }" class="text-white text-decoration-none"><h5>${
      newsArr[0].title || ""
    }</h5></a>
                    <p class="card-text">${
                      newsArr[0].summary || newsArr[0].excerpt || ""
                    }</p>
                    <p class="card-text text-secondary">${
                      newsArr[0].body ? newsArr[0].body.substring(0, 120) : ""
                    }</p>
                    <p class="card-text text-info">${
                      newsArr[0].author ? "الكاتب: " + newsArr[0].author : ""
                    }</p>
                </div>
            </div>
        </div>`;
  }
  html += '<div class="col-md-3">';
  for (let i = 1; i <= 2; i++) {
    if (newsArr[i]) {
      html += `
            <div class="card mb-3 border-0">
                <a href="details.php?id=${newsArr[i].id}"><img src="assets/${
        newsArr[i].image
      }" class="card-img-top" alt="${
        newsArr[i].title
      }" style="aspect-ratio:16/14;object-fit:cover;"></a>
                <div class="card-body">
                    <h6 class="card-title text-secondary-emphasis">${
                      newsArr[i].category || ""
                    }</h6>
                    <a href="details.php?id=${
                      newsArr[i].id
                    }" class="text-dark text-decoration-none"><p class="card-text font-weight-bold text-dark">${
        newsArr[i].title || ""
      }</p></a>
                    <p class="card-text text-info">${
                      newsArr[i].author ? "الكاتب: " + newsArr[i].author : ""
                    }</p>
                </div>
            </div>`;
    }
  }
  html += "</div>";
  html += '<div class="col-md-3">';
  for (let i = 3; i <= 4; i++) {
    if (newsArr[i]) {
      html += `
            <div class="card mb-3 border-0">
                <a href="details.php?id=${newsArr[i].id}"><img src="assets/${
        newsArr[i].image
      }" class="card-img-top" alt="${
        newsArr[i].title
      }" style="aspect-ratio:16/14;object-fit:cover;"></a>
                <div class="card-body">
                    <h5 class="card-title">${newsArr[i].category || ""}</h5>
                    <a href="details.php?id=${
                      newsArr[i].id
                    }" class="text-dark text-decoration-none"><p class="card-text">${
        newsArr[i].title || ""
      }</p></a>
                    <p class="card-text text-info">${
                      newsArr[i].author ? "الكاتب: " + newsArr[i].author : ""
                    }</p>
                </div>
            </div>`;
    }
  }
  html += "</div>";
  return html;
}

function loadMainRandomNews() {
  fetch("random_news.php")
    .then((res) => res.json())
    .then((data) => {
      document.getElementById("main-random-news").innerHTML =
        renderMainRandomNews(data);
    })
    .catch(() => {
      document.getElementById("main-random-news").innerHTML =
        '<div class="alert alert-danger">حدث خطأ أثناء تحميل الأخبار.</div>';
    });
}
window.addEventListener("DOMContentLoaded", loadMainRandomNews);

function renderMostReadSection(data) {
  let listHtml = data.list
    .map(
      (item, idx) => `
        <li class="py-2 border-bottom">
            <strong class="text-muted">${idx + 1}.</strong>
            <a href="details.php?id=${
              item.id
            }" class="text-decoration-none text-dark">${item.title}</a>
        </li>
    `
    )
    .join("");
  let moreNewsHtml = "";
  if (data.moreNews && data.moreNews.length) {
    moreNewsHtml = `
            <div class="mt-4">
                <div class="row g-3">
                    ${data.moreNews
                      .slice(0, 3)
                      .map((news, idx) => {
                        if (idx === 0) {
                          return `
                            <div class="col-md-6 col-lg-4">
                                <div class="card border-0 h-100 d-flex flex-column">
                                    <a href="details.php?id=${
                                      news.id
                                    }"><img src="assets/${
                            news.image || "more1.png"
                          }" class="card-img-top" alt="News Image" style="aspect-ratio:16/14;object-fit:cover;"></a>
                                    <div class="card-body">
                                        <span class="text-secondary">${
                                          news.category || ""
                                        }</span>
                                        <h6 class="card-title">
                                            <a href="details.php?id=${
                                              news.id
                                            }" class="text-decoration-none text-dark">${
                            news.title
                          }</a>
                                        </h6>
                                        <p class="card-text text-secondary">${
                                          news.excerpt || ""
                                        }</p>
                                    </div>
                                </div>
                            </div>
                            `;
                        } else {
                          return `
                            <div class="col-md-6 col-lg-4">
                                <div class="card border-0 h-100 d-flex flex-column">
                                    <div class="card-body order-1 mb-2">
                                        <span class="text-secondary">${
                                          news.category || ""
                                        }</span>
                                        <h6 class="card-title">
                                            <a href="details.php?id=${
                                              news.id
                                            }" class="text-decoration-none text-dark">${
                            news.title
                          }</a>
                                        </h6>
                                        <p class="card-text text-secondary">${
                                          news.excerpt || ""
                                        }</p>
                                    </div>
                                    <a href="details.php?id=${
                                      news.id
                                    }" class="order-2 mt-1"><img src="assets/${
                            news.image || "more1.png"
                          }" class="card-img-top" alt="News Image" style="aspect-ratio:16/14;object-fit:cover;"></a>
                                </div>
                            </div>
                            `;
                        }
                      })
                      .join("")}
                </div>
            </div>
        `;
  } else {
    moreNewsHtml =
      '<div class="alert alert-info">لا يوجد المزيد من الأخبار.</div>';
  }
  return `
        <div class="row ">
            <span class="col-md border-bottom">
                <div class="d-flex justify-content-between mt-3">
                    <div class="border-bottom border-3 border-primary pb-1">
                        <h5 class="text-secondary">الاكثر قراءة</h5>
                    </div>
                    <div class="border-bottom border-3 border-primary pb-1">
                        <h5>المزيد من الأخبار</h5>
                    </div>
                    <div>
                        <div class="col">
                            <a class="text-decoration-none text-primary" href="#more-news-list"> المزيد</a>
                        </div>
                    </div>
                </div>
            </span>
        </div>
        <section class="row mt-3">
            <div class="col-md-4">
                <ul class="list-unstyled">${listHtml}</ul>
            </div>
            <div class="col-md-8">
                <div id="more-news-list">${moreNewsHtml}</div>
            </div>
        </section>
    `;
}
function loadMostReadSection() {
  fetch("most_read.php")
    .then((res) => res.json())
    .then((data) => {
      document.getElementById("most-read-section").innerHTML =
        renderMostReadSection(data);
    });
}
window.addEventListener("DOMContentLoaded", loadMostReadSection);

function addCategoryMoreLinks() {
  const sectionMap = {
    "political-news-section": "سياسة",
    "economic-news-section": "اقتصاد",
    "sport-news-section": "رياضة",
    "health-news-section": "صحة",
  };
  Object.entries(sectionMap).forEach(([sectionId, category]) => {
    const section = document.getElementById(sectionId);
    if (section) {
      section.addEventListener("click", function (e) {
        const target = e.target;
        if (target && target.matches("a.text-decoration-none, a.more-link")) {
          e.preventDefault();
          window.location.href = `catogry.php?category=${encodeURIComponent(
            category
          )}`;
        }
      });
    }
  });
}
window.addEventListener("DOMContentLoaded", addCategoryMoreLinks);

const mainSearchForm = document.getElementById("main-search-form");
if (mainSearchForm) {
  mainSearchForm.addEventListener("submit", function (e) {
    e.preventDefault();
    const q = this.querySelector('input[type="search"]').value.trim();
    if (!q) return;
    window.location.href = `catogry.php?q=${encodeURIComponent(q)}`;
  });
}

function renderSectionWithMainAndSideCards(data, sectionTitle) {
  let mainCard = data.main
    ? `
        <div class="col-md-6">
            <div class="card border-0 h-100">
                <a href="details.php?id=${data.main.id}"><img src="assets/${data.main.image}" class="card-img-top" alt="${data.main.title}" style="aspect-ratio:16/14;object-fit:cover;"></a>
                <div class="card-body">
                    <h6 class="card-title mt-2">${data.main.category}</h6>
                    <a href="details.php?id=${data.main.id}" class="text-decoration-none text-dark"><strong>${data.main.title}</strong></a>
                    <p class="text-secondary">${data.main.excerpt}</p>
                </div>
            </div>
        </div>
    `
    : "";
  let sideCards = "";
  if (data.side && data.side.length > 0) {
    for (let i = 0; i < 4; i += 2) {
      sideCards += '<div class="col-md-3 d-flex flex-column gap-2">';
      for (let j = i; j < i + 2 && j < data.side.length; j++) {
        const card = data.side[j];
        sideCards += `
<div class="card border-0 mb-2 p-1" style="font-size:0.92rem;">
    <a href="details.php?id=${card.id}"><img src="assets/${
          card.image
        }" class="card-img-top" alt="${
          card.title
        }" style="aspect-ratio:16/14;object-fit:cover;"></a>
    <div class="card-body p-2">
        <h6 class="card-title text-secondary-emphasis mb-1" style="font-size:0.95rem;">${
          card.category || ""
        }</h6>
        <a href="details.php?id=${
          card.id
        }" class="text-dark text-decoration-none"><p class="card-text font-weight-bold text-dark mb-1" style="font-size:0.98rem;">${
          card.title || ""
        }</p></a>
        <p class="card-text text-info mb-0" style="font-size:0.9rem;">${
          card.author ? "الكاتب: " + card.author : ""
        }</p>
    </div>
</div>
`;
      }
      sideCards += "</div>";
    }
  }
  return `
        <div class="row ">
            <span class="col-md border-bottom">
                <div class="d-flex justify-content-between">
                    <h5>
                        <span class="border-bottom border-4 border-primary pb-1 container">${sectionTitle}</span>
                    </h5>
                    <a href="#" class="text-decoration-none">المزيد</a>
                </div>
            </span>
        </div>
        <div class="row g-3">
            ${mainCard}
            ${sideCards}
        </div>
    `;
}
function loadPoliticalNewsSection() {
  fetch("section_news.php?category=سياسة&full=1")
    .then((res) => res.json())
    .then((data) => {
      document.getElementById("political-news-section").innerHTML =
        renderSectionWithMainAndSideCards(data, "سياسة");
    });
}
window.addEventListener("DOMContentLoaded", loadPoliticalNewsSection);

function renderSportNewsSection(data) {
  let mainCard = data.main
    ? `
        <div class="col-md-6 gy-3">
            <div class="card border-0 h-100">
                <a href="details.php?id=${data.main.id}"><img src="assets/${data.main.image}" class="card-img-top" alt="${data.main.title}" style="aspect-ratio:16/14;object-fit:cover;"></a>
                <div class="card-body">
                    <h6 class="card-title">${data.main.category}</h6>
                    <a href="details.php?id=${data.main.id}" class="text-decoration-none text-dark"><strong>${data.main.title}</strong></a>
                    <p class="text-secondary">${data.main.excerpt}</p>
                </div>
            </div>
        </div>
    `
    : "";
  let sideCards = "";
  if (data.side && data.side.length > 0) {
    for (let i = 0; i < 4; i += 2) {
      sideCards += '<div class="col-md-3 d-flex flex-column gap-2">';
      for (let j = i; j < i + 2 && j < data.side.length; j++) {
        const card = data.side[j];
        sideCards += `
<div class="card border-0 mb-2 p-1" style="font-size:0.92rem;">
    <a href="details.php?id=${card.id}"><img src="assets/${
          card.image
        }" class="card-img-top" alt="${
          card.title
        }" style="aspect-ratio:16/14;object-fit:cover;"></a>
    <div class="card-body p-2">
        <h6 class="card-title text-secondary-emphasis mb-1" style="font-size:0.95rem;">${
          card.category || ""
        }</h6>
        <a href="details.php?id=${
          card.id
        }" class="text-dark text-decoration-none"><p class="card-text font-weight-bold text-dark mb-1" style="font-size:0.98rem;">${
          card.title || ""
        }</p></a>
        <p class="card-text text-info mb-0" style="font-size:0.9rem;">${
          card.author ? "الكاتب: " + card.author : ""
        }</p>
    </div>
</div>
`;
      }
      sideCards += "</div>";
    }
  }
  return `
        <div class="row gy-3">
            <span class="col-md border-bottom">
                <div class="d-flex justify-content-between">
                    <h6>
                        <span class="border-bottom border-4 border-primary pb-1 container">رياضة</span>
                    </h6>
                    <a href="#" class="text-decoration-none">المزيد</a>
                </div>
            </span>
        </div>
        <div class="row g-3">
            ${mainCard}
            ${sideCards}
        </div>
    `;
}
function loadSportNewsSection() {
  fetch("section_news.php?category=رياضة&full=1")
    .then((res) => res.json())
    .then((data) => {
      document.getElementById("sport-news-section").innerHTML =
        renderSportNewsSection(data);
    });
}
window.addEventListener("DOMContentLoaded", loadSportNewsSection);

function renderHealthNewsSection(data) {
  let mainCard = data.main
    ? `
        <div class="col-md-6">
            <div class="card border-0 h-100">
                <a href="details.php?id=${data.main.id}"><img src="assets/${data.main.image}" class="card-img-top" alt="${data.main.title}" style="aspect-ratio:16/14;object-fit:cover;"></a>
                <div class="card-body">
                    <h5 class="card-title px-2">${data.main.category}</h5>
                    <a href="details.php?id=${data.main.id}" class="text-decoration-none text-dark"><strong>${data.main.title}</strong></a>
                    <p class="text-secondary">${data.main.excerpt}</p>
                </div>
            </div>
        </div>
    `
    : "";
  let sideCards = "";
  if (data.side && data.side.length > 0) {
    for (let i = 0; i < 4; i += 2) {
      sideCards += '<div class="col-md-3 d-flex flex-column gap-2">';
      for (let j = i; j < i + 2 && j < data.side.length; j++) {
        const card = data.side[j];
        sideCards += `
<div class="card border-0 mb-2 p-1" style="font-size:0.92rem;">
    <a href="details.php?id=${card.id}"><img src="assets/${
          card.image
        }" class="card-img-top" alt="${
          card.title
        }" style="aspect-ratio:16/14;object-fit:cover;"></a>
    <div class="card-body p-2">
        <h6 class="card-title text-secondary-emphasis mb-1" style="font-size:0.95rem;">${
          card.category || ""
        }</h6>
        <a href="details.php?id=${
          card.id
        }" class="text-dark text-decoration-none"><p class="card-text font-weight-bold text-dark mb-1" style="font-size:0.98rem;">${
          card.title || ""
        }</p></a>
        <p class="card-text text-info mb-0" style="font-size:0.9rem;">${
          card.author ? "الكاتب: " + card.author : ""
        }</p>
    </div>
</div>
`;
      }
      sideCards += "</div>";
    }
  }
  return `
        <div class="row gy-3">
            <span class="col-md border-bottom">
                <div class="d-flex justify-content-between">
                    <h5>
                        <span class="border-bottom border-4 border-primary pb-1 container">صحة</span>
                    </h5>
                    <a href="#" class="text-decoration-none">المزيد</a>
                </div>
            </span>
        </div>
        <div class="row g-3">
            ${mainCard}
            ${sideCards}
        </div>
    `;
}
function loadHealthNewsSection() {
  fetch("section_news.php?category=صحة&full=1")
    .then((res) => res.json())
    .then((data) => {
      document.getElementById("health-news-section").innerHTML =
        renderHealthNewsSection(data);
    });
}
window.addEventListener("DOMContentLoaded", loadHealthNewsSection);
