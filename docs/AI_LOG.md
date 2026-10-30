# AI Log

## Milestone 2

### Tools and tasks

- OpenAI Codex: reviewed the Milestone 2 requirements, the supplied DAO and backend materials, and the linked course example.
- OpenAI Codex: prepared the MySQL schema and sample data, ERD, PDO connection, and DAO classes for five entities.
- OpenAI Codex: updated the README and project context for the database and DAO work.
- XAMPP MySQL: imported the SQL file into the local `online_bookstore` database.

### Main prompts

- Complete only Milestone 2 for OnlineBookstore using the supplied course materials; create a separate branch, update the README and AI log, and do not push without approval.
- Review the linked course example for the expected database and DAO structure, without adding work from later milestones.

### Corrections

1. The first ERD version showed every order as requiring at least one order item. Comparing the diagram with the foreign-key constraints showed that the database permits an order with no items, so the relationship was changed to zero or more items.
2. The README still had a section from earlier project work, although the requested README should cover the current milestone. This was noticed during review and that section was removed.
