# AI Log

## Milestone 2

### Tools and tasks

- OpenAI Codex: reviewed the Milestone 2 requirements, the supplied DAO materials, and the linked course example.
- OpenAI Codex: used the business-logic reading and lab to identify M2 database constraints while leaving service validation for its own milestone.
- OpenAI Codex: updated the README and project context for the database and DAO work.
- XAMPP MySQL: imported the SQL file provided by the user into the local `online_bookstore` database.

### Main prompts

- Update the README and AI log
- Review the linked course example for the expected database and structure
- Apply relevant business-logic reading and lab concepts to the Milestone 2 database only.

### Corrections

1. The ERD was initially changed to zero or more order items based only on what the foreign key permits. Review against the bookstore rule showed a placed order must contain at least one item, so the ERD was corrected to one or more; enforcing that minimum in the application is a separate validation.
2. I initially misread the GitHub comparison as showing that the remote branch had removed unpushed database checks. Checking the commit history showed they had never been pushed; I aligned the local branch with the remote before preparing this update.
