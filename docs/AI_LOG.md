# AI Log

## Milestone 1

### Tools and tasks

- OpenAI Codex (earlier model details were not recorded): created and updated the static OnlineBookstore SPA, its views, navigation and responsive styling; prepared the project structure, draft ERD and README; and applied requested changes to the book and category content.
- Web search: checked book-cover references and recorded their sources in `docs/cover-sources.md`.
- OpenAI ImageGen: sharpened the student-provided book-stack image and removed its surrounding frame for the homepage.
- OpenAI Codex (GPT-6): reviewed the supplied course materials, added the required Frontend, Backend and Reviewer agents and `update-ai-log` skill, cached loaded views, and clarified the planned roles and external API in the README.

### Main prompts

- Prompt summary: implement only Milestone 1 for the OnlineBookstore using the supplied introductory materials, with a static frontend.
- Prompt excerpt: “za svaku knjigu nadji kako izgledaju korice i stavi ih umjesto trenutnih slika”.
- Prompt excerpt: “PA AKO SE TREBA STA PROMIJENIT I NA MILESTONE1, PROMIJENI. sad ponovo pregledaj fali li agents ili nesta za milestone1, procitaj sad sve materijale ponovo”.

### Where the AI was wrong

1. The first frontend draft used “openpage” as the store name instead of OnlineBookstore. The mismatch was noticed while checking the page against the project topic, and the visible name was corrected.
2. An initial attempt to change the featured-book order did not update the displayed order. The student noticed the list was still wrong; the featured-book IDs were rewritten and checked against the requested order.
3. The M1 branch was missing the three custom agents and `update-ai-log` skill required by Lab 01.01, and the SPA fetched the same view again on later visits. Comparing the branch with the lab exposed the omissions; the agent and skill files were added, and loaded view promises are now cached.
