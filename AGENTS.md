# OnlineBookstore project context

OnlineBookstore is a bookstore web application for the IT 2001 Web Programming course. The current work is Milestone 1.

## Roles and planned data

- Customer: browses books and categories, and will manage their cart, profile, and orders.
- Admin: will manage the bookstore catalog in a later milestone.
- Planned entities: Users, Books, Categories, Orders, and OrderItems.

## Technology stack

- Frontend: HTML, CSS, and JavaScript in `frontend/`.
- Planned backend: PHP with FlightPHP, using PDO to access MySQL, in `backend/`.

## Architecture

- Keep frontend and backend code separate. Frontend files must not contain backend or database code.
- The frontend is a single-page application. Shared page structure is in `frontend/index.html`; page templates are in `frontend/views/`; shared styles and scripts are in `frontend/css/` and `frontend/js/`.
- Keep the frontend static in Milestone 1. Do not add authentication, database access, backend routes, API requests, or data persistence. Forms, cart, and account pages are previews.
- The external book-information feature is planned for the book detail page. Do not implement it in Milestone 1.
- Keep the interface responsive and use the existing visual style and conventions.

## Folder structure

```text
.agents/
  skills/
    update-ai-log/
      SKILL.md
.github/
  agents/
    backend.agent.md
    frontend.agent.md
    reviewer.agent.md
backend/
  config/
  dao/
  logs/
  middleware/
  routes/
  services/
docs/
  AI_LOG.md
  ERD.md
frontend/
  assets/
    covers/
  css/
  js/
  views/
```

## Frontend rules

- Keep each page view in `frontend/views/` and use the shared navigation, CSS, and JavaScript files.
- Keep Milestone 1 pages static. Forms and account features are previews and must not access the database or backend.
- Keep the planned external book-information feature on the book detail page as a placeholder until its milestone.

## Backend rules

- Keep the frontend and backend separate.
- Keep the required backend folders in place. Do not add backend implementation during Milestone 1.
- When backend work begins, keep requests in the order route, service, DAO, database.

## Naming conventions

- Use lowercase names for folders and frontend files.
- Use PascalCase for PHP classes and matching filenames, camelCase for PHP and JavaScript variables, and snake_case for database tables and columns.

## Rules for AI assistants

- Follow the active milestone and do not add features from later milestones.
- Do not add libraries or frameworks without asking first.
- Keep real passwords, API keys, local configuration, logs, and `backend/vendor/` out of Git.
- Keep project documentation accurate to the current milestone.
- Make focused changes and report the files changed and checks performed.
