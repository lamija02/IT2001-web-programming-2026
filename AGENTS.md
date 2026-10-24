# Project context

OnlineBookstore is a single-page web application being developed in milestones for IT 2001 Web Programming.

## Technology and structure

- Frontend: HTML, CSS, and JavaScript.
- Backend: PHP REST API and MySQL, to be developed in later milestones.
- Keep frontend and backend code separate.
- Frontend files belong in `frontend/`; backend files belong in `backend/`.
- Frontend views are static in Milestone 1 and must not make backend requests.
- Keep forms, cart, and dashboard as static previews; do not persist or process user data in this milestone.
- Keep the user interface responsive and navigate between SPA views without full page reloads.
- Keep `backend/config/config.php`, logs, and `backend/vendor/` out of Git.

## Current milestone

Milestone 1 covers project structure, static frontend pages and components, and a draft ERD. Do not implement database access, backend routes, authentication, or API integration as part of this milestone.

## Naming and editing

- Use descriptive, lowercase file names.
- Keep HTML, CSS, and JavaScript in their respective frontend folders.
- Keep the shared page shell in `frontend/index.html` and load view templates from `frontend/views/`.
- Do not put credentials or secrets in frontend files.
- Keep the README accurate to the current milestone.
