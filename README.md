# 📰 Internet Programming Project

## 📌 Project Overview

A web-based news platform for publishing and browsing news across various categories such as politics, economy, sports, and health. Users can search for news, view details, and leave comments.

---

## 🎯 Key Features

- Browse news by category
- Search news by keywords or titles
- News details page with image, text, comments, and related articles
- Comment system for visitors
- Role-based dashboards:

  - **Admin:** Manage users, ads, and content
  - **Editor:** Review and approve/reject submitted news
  - **Author:** Add/edit their own news and track status

- Random ad display from the database
- Responsive UI using Bootstrap

---

## 🛠️ Technologies Used

- **Backend:** PHP
- **Database:** MySQL
- **Frontend:** HTML, CSS, JavaScript, Bootstrap

---

## 📁 Main Files

| File                                               | Purpose                   |
| -------------------------------------------------- | ------------------------- |
| `index.php`                                        | Homepage                  |
| `catogry.php`                                      | News by category          |
| `details.php`                                      | News details and comments |
| `admin_dash.php`                                   | Admin dashboard           |
| `editor_dash.php`                                  | Editor dashboard          |
| `author_dash.php`                                  | Author dashboard          |
| `add_news.php`, `edit_news.php`                    | Add/edit news             |
| `add_user.php`, `edit_user.php`, `delete_user.php` | User management           |
| `comments.php`                                     | Display comments          |
| `config.php`                                       | Database connection       |
| **API Files**                                      |                           |
| `search_api.php`                                   | Search news API           |
| `category_api.php`                                 | Category news API         |
| `details_api.php`                                  | News details API          |
| `agent_api.php`                                    | User/agent API            |

---

## 🔌 API Endpoints

The platform provides several REST API endpoints for programmatic access:

### Agent API
- **Get all agents:** `GET /agent_api.php`
- **Get agents by role:** `GET /agent_api.php?role=admin|editor|author`
- **Get specific agent:** `GET /agent_api.php?action=get&id={id}`

### News APIs
- **Search news:** `GET /search_api.php?q={query}`
- **Get news by category:** `GET /category_api.php?category={category}`
- **Get news details:** `GET /details_api.php?id={id}`

📖 **API Documentation:** See `AGENT_API.md` for detailed agent API documentation and examples.

🧪 **API Testing:** Open `agent_api_test.html` in your browser to test the agent API endpoints.

---

## ▶️ How to Run

1. Install XAMPP or any local server with PHP & MySQL
2. Place project files in the `htdocs` folder
3. Create a MySQL database and update credentials in `config.php`
4. Import the provided SQL database
5. Open your browser and visit:
   `http://localhost/InternetProgrammingProject/index.php`

---

## 🔐 Security Notes

- All queries use **prepared statements** to prevent SQL Injection
- User input is sanitized using `htmlspecialchars` to prevent XSS
- All forms validate input data before processing
