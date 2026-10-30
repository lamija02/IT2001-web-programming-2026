# AI Log

## Milestone 2

### Tools and tasks

- OpenAI Codex: reviewed the Milestone 2 requirements, supplied DAO materials, and linked course example; prepared the database schema and DAOs for five entities.
- XAMPP MySQL: imported the SQL file into the local `online_bookstore` database.

### Main prompts

- Prompt summary: apply the relevant database-layer material without adding services to Milestone 2.

### Where the AI was wrong

1. The ERD was changed to show zero or more order items based only on what the foreign key permits. The student pointed out that a placed order cannot be empty; the ERD was corrected to one or more items.
2. Checking the commit history showed the checks had not been pushed; the local branch was aligned with the remote before continuing.
3. The first order DAO allowed an order to be created without order items. The order creation method now requires at least one item and saves the order and its items in one transaction.
