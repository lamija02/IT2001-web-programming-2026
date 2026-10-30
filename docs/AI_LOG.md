# AI Log

## Milestone 1

### Tools and tasks

- OpenAI Codex: prepared the OnlineBookstore project structure and static SPA views, navigation, responsive styling, draft ERD, and project documentation.
- Web search: looked up book-cover references and recorded sources in `docs/cover-sources.md`.

### Main prompts

- Prompt summary: complete the Milestone 1 parts supported by the supplied introduction materials for the OnlineBookstore, keeping the frontend static.

### Where the AI was wrong

1. An early frontend draft displayed “openpage” instead of OnlineBookstore. The mismatch was noticed while reviewing the project against its topic, and the displayed name was corrected.
2. An attempted change to the featured-book order did not change the displayed order. The list was checked, and the featured-book IDs were corrected.

## Milestone 2

### Tools and tasks

- OpenAI Codex: reviewed the Milestone 2 requirements, supplied DAO materials, and linked course example; prepared the database schema, sample data, ERD, PDO connection, and DAOs for five entities.
- OpenAI Codex: added the three custom agent profiles, AI log skill, and DAO verification script required by the supplied labs.
- XAMPP MySQL: imported the SQL file into the local `online_bookstore` database. PHP CLI: ran the DAO verification script.

### Main prompts

- Prompt summary: complete only Milestone 2 on its own branch, update project documentation, and wait for approval before pushing.
- Prompt summary: apply the relevant database-layer material without adding services to Milestone 2.

### Where the AI was wrong

1. The ERD was changed to show zero or more order items based only on what the foreign key permits. The student pointed out that a placed order cannot be empty; the ERD was corrected to one or more items.
2. I initially said the custom agent files were optional. Checking Lab 01.01 showed that it asks for Frontend, Backend, and Reviewer agents plus the AI log skill, so those files were added.
3. I initially misread a GitHub comparison as showing that the remote branch had removed local database checks. Checking the commit history showed the checks had not been pushed; the local branch was aligned with the remote before continuing.