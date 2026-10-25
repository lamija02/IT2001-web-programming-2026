# AI Log

## Milestone 1

### Tools and tasks

- OpenAI Codex (model details were not recorded for the earlier project work): reviewed the supplied course and project documents, prepared the frontend/backend folder structure, built and updated the static SPA, drafted the ERD and README, and checked the project against Milestone 1. Prompt summary: implement only the Milestone 1 part of the OnlineBookstore project, using the supplied materials and keeping later milestone work out. The project structure, SPA, ERD, and README draft were kept; the student later specified changes to the featured books, categories, ordering, and images, which were applied.
- Web search: looked up book-cover references for the selected catalog and recorded source links in `docs/cover-sources.md`. Prompt excerpt: “za svaku knjigu nadji kako izgledaju korice i stavi ih umjesto trenutnih slika”. The selected cover files and source list were kept in the project.
- ImageGen: created a sharper derivative of the user-provided book-stack image for the homepage after the student asked to sharpen it and remove the surrounding frame. The derivative was kept as the homepage image.
- OpenAI Codex (model details not recorded): updated the milestone documentation from Lab 01.01 and added the Frontend, Backend, and Reviewer agents and the `update-ai-log` skill. Prompt excerpt: “hajde riješi to i pushaj na github, nemoj da nesta fali”. The student later requested that the agent and skill folders be removed; they were removed from the branch. Prompt excerpt: “obrisi mi ove, ne trebaju”.

### Where the AI was wrong

1. The first frontend draft used “openpage” as the store name instead of OnlineBookstore. The mismatch was noticed while reviewing the page against the project topic, and the visible store name was changed to OnlineBookstore.
2. An initial attempt to change the order of the featured books did not update the displayed order. The student noticed the list was still wrong; the featured-book ID list was rewritten in the requested order and checked against it.
