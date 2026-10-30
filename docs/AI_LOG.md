# AI Log

## Milestone 1

### Tools and tasks

- OpenAI Codex: reviewed the supplied course and project documents, prepared the frontend folder structure and checked the project against Milestone 1. 
- Web search: looked up book-cover references for the selected catalog and recorded source links in `docs/cover-sources.md`. 
- OpenAI Codex: updated the milestone documentation from Lab 01.01.

### Where the AI was wrong

1. The first frontend draft used “openpage” as the store name instead of OnlineBookstore. The mismatch was noticed while reviewing the page against the project topic, and the visible store name was changed to OnlineBookstore.
2. An initial attempt to change the order of the featured books did not update the displayed order. The student noticed the list was still wrong; the featured-book ID list was rewritten in the requested order and checked against it.

## Milestone 2

### Tools and tasks

- OpenAI Codex: reviewed the Milestone 2 requirements, DAO and backend reading materials, and the linked course example repository.
- OpenAI Codex: prepared the MySQL schema and sample rows, documented the entities and relationships, and created the shared PDO connection and DAO classes for the five entities.
- OpenAI Codex: updated the project guidance and README with the Milestone 2 scope and local database setup steps.
- XAMPP MySQL: imported `database/online_bookstore.sql` into the local `online_bookstore` database.

### Main prompts

- Complete only Milestone 2 for OnlineBookstore using the supplied course materials; create a separate `milestone2` branch, update the README and AI log, and do not push without approval.
- Check the linked course example for the expected database and DAO structure without adding work from later milestones.

### Where the AI was wrong

1. A PDF-reading command initially had a quoting error and did not extract the requested text. The error was visible in the terminal output; the command was corrected and the reading was completed.
2. The Windows terminal could not print accented characters from a PDF using its default encoding. The encoding was changed to UTF-8 and the text was read successfully.
