# AI Log

## Milestone 3

### Tools and tasks

- Prompt summary: use only the supplied documents and the linked project as a reference; implement only an initial part of Milestone 3
- Student added a shared service base, HTTP exceptions, validation helpers and category rules with the DAO queries those rules need. This work is local and awaits Codex review.

### Where the AI was wrong

1. The initial branch plan used the existing `milestone2` branch as the base. GitHub showed it was six commits behind `main`, so the local `milestone3` branch was created from the current `main`. The remote branch was left unchanged.
2. OrderService initially used the required-field validator for an array of order items, and transaction handling was initially placed in OrderDao. Student's review identified both issues; array validation was handled in the service, and transaction handling was moved to OrderService.
