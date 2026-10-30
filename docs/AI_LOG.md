# AI Log

## Milestone 2

### Tools and tasks

- OpenAI Codex: reviewed the Milestone 2 requirements, the supplied DAO materials, and the linked course example.
- OpenAI Codex: updated the README and project context for the database and DAO work.
- XAMPP MySQL: imported the SQL file provided by the user into the local `online_bookstore` database.

### Main prompts

- Update the README and AI log
- Review the linked course example for the expected database and structure

### Corrections

1. AI temporarily changed the order-to-items relationship to zero or more, as requested by the user, based only on what the foreign key permits. The bookstore rule is that a placed order must contain at least one item, so the ERD was corrected to one or more; enforcing that minimum in the application is a separate validation.
