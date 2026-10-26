# OnlineBookstore project context

OnlineBookstore is a bookstore web application for the IT 2001 Web Programming course. The current work is Milestone 1.

## Roles and planned data

- Customer: browses books and categories, and will manage their cart, profile, and orders.
- Admin: will manage the bookstore catalog in a later milestone.
- Planned entities: Users, Books, Categories, Orders, and OrderItems.

## Technology and architecture

- Frontend: HTML, CSS, and JavaScript in `frontend/`.
- Planned backend: PHP with FlightPHP, using PDO to access MySQL, in `backend/`.
- Keep frontend and backend code separate. Frontend files must not contain backend or database code.
- The frontend is a single-page application. Shared page structure is in `frontend/index.html`; page templates are in `frontend/views/`; shared styles and scripts are in `frontend/css/` and `frontend/js/`.
- Keep the frontend static in Milestone 1. Do not add authentication, database access, backend routes, API requests, or data persistence. Forms, cart, and account pages are previews.
- The external book-information feature is planned for the book detail page. Do not implement it in Milestone 1.
- Keep the interface responsive and use the existing visual style and conventions.

## Folder structure

```text
backend/
  config/
  dao/
  logs/
  middleware/
  routes/
  services/
docs/
frontend/
  assets/
    covers/
  css/
  js/
  views/
```

## File and security rules

- Keep PHP files in `backend/`; keep HTML, CSS, and JavaScript in their corresponding `frontend/` folders.
- Never put passwords, API keys, or other secrets in committed files. Keep local configuration, log files, and `backend/vendor/` out of Git.
- Keep the README, ERD, and AI usage log accurate to the current milestone.
