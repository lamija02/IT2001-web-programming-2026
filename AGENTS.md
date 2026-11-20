# OnlineBookstore project context

OnlineBookstore is a bookstore web application for the IT Web Programming course. Milestone 1 provides the static frontend and Milestone 2 added the database and DAO layer. The active implementation is Milestone 3.

## Project

- Roles: Customer and Admin.
- Entities: Users, Books, Categories, Orders, and OrderItems.

## Technology stack

- Frontend: HTML, CSS, and JavaScript in `frontend/`.
- Backend: PHP, FlightPHP, PDO, and MySQL in `backend/`.
- Local development: XAMPP.

## Architecture

- Keep frontend and backend code separate.
- The frontend is a single-page application. `frontend/index.html` loads views from `frontend/views/` and shared styles and scripts from `frontend/css/` and `frontend/js/`.
- Keep the frontend static until a milestone requires backend integration.
- Backend requests follow routes, services, DAOs, then the database. DAOs contain SQL; services validate input and apply business rules; routes handle HTTP requests and responses.
- Only services call DAOs. Keep SQL out of services and routes.
- Milestone 3 adds the business logic and REST API layers, OpenAPI documentation, and an external API endpoint. Keep the existing frontend static until its milestone requires backend integration.
- Use prepared statements for SQL values. Only fixed table names and allow-listed column names may be included in generated SQL.

## Folder structure

```text
.agents/skills/update-ai-log/SKILL.md
.github/agents/frontend.agent.md
.github/agents/backend.agent.md
.github/agents/reviewer.agent.md
backend/
  utils/
  services/
  routes/
  config/
  dao/
  logs/
  middleware/
database/online_bookstore.sql
docs/
  AI_LOG.md
  ERD.md
frontend/
  assets/
  css/
  js/
  views/
```

## Frontend rules

- Keep HTML views in `frontend/views/`, styles in `frontend/css/`, scripts in `frontend/js/`, and static assets in `frontend/assets/`.
- Keep SPA navigation and the existing visual style. Load each view template only once per browser session. Connect the frontend to the backend in Milestone 4.

## Backend rules

- Keep PHP files in `backend/` and the database creation script in `database/`.
- Keep database queries in DAO classes and use the shared PDO connection in `backend/config/Database.php`.
- Use one DAO per database entity and the shared `BaseDao` for CRUD methods. Add entity-specific SQL methods to the relevant DAO.
- Keep validation and application rules in one service per entity. Services call the DAOs and return data or throw an exception with an HTTP status code.
- Never put HTTP or frontend code in a DAO.

## Naming conventions

- PHP classes and their files use PascalCase, for example `BookDao` and `BookDao.php`.
- PHP and JavaScript variables use camelCase.
- PHP methods use camelCase to match the existing classes.
- Database tables and columns use snake_case.

## Rules for AI assistants

- Read this file and the active milestone requirements before changing files.
- Do not add libraries or frameworks without asking first.
- Do not change the database schema unless the user asks for that change.
- Keep real credentials in the ignored `backend/config/config.php`; commit only `config.example.php`.
- Do not edit files in `backend/logs/`.
- Do not commit or push unless the user explicitly approves it.
