# OnlineBookstore project context

OnlineBookstore is a bookstore web application for the IT 2001 Web Programming course. The active work is Milestone 2.

## Roles and planned data

- Customer: browses books and categories, and will manage a cart, profile, and orders.
- Admin: will manage the bookstore catalog in a later milestone.
- Database entities: Users, Books, Categories, Orders, and OrderItems.

## Technology and architecture

- Frontend: HTML, CSS, and JavaScript in `frontend/`.
- Backend: PHP with FlightPHP and PDO/MySQL, in `backend/`.
- Keep frontend and backend code separate.
- The frontend is a single-page application. Shared page structure is in `frontend/index.html`; page templates are in `frontend/views/`; shared styles and scripts are in `frontend/css/` and `frontend/js/`.
- Milestone 1's frontend remains static. Milestone 2 adds only the MySQL schema, sample data, PDO configuration example, and DAO classes for the five entities.
- Keep SQL in DAO classes. Use prepared statements for values and allow only known table and column names in generated SQL.
- Do not add services, routes, API endpoints, authentication, or frontend/database integration in Milestone 2; those belong to later milestones.

## Folder structure

```text
backend/
  config/
    config.example.php
    Database.php
  dao/
    BaseDao.php
    UserDao.php
    BookDao.php
    CategoryDao.php
    OrderDao.php
    OrderItemDao.php
  logs/
  middleware/
  routes/
  services/
database/
  online_bookstore.sql
docs/
  ERD.md
frontend/
  assets/
  css/
  js/
  views/
```

## File and security rules

- Keep PHP files in `backend/`; keep HTML, CSS, and JavaScript in their corresponding `frontend/` folders.
- Keep real local database credentials in ignored `backend/config/config.php`; commit only `config.example.php`.
- Keep log files and `backend/vendor/` out of Git.
- Keep the README, ERD, and AI usage log accurate to the active milestone.
