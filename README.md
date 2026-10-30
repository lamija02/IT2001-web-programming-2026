# OnlineBookstore

OnlineBookstore is a static bookstore interface for browsing books and categories.

## Milestone 1

The frontend contains static pages with SPA navigation. The backend folder structure is reserved for later milestones and contains no backend implementation.

## Planned roles

- Customer: browse books and categories, and view cart, profile, and order pages.
- Admin: manage the bookstore catalog in a later milestone.
- Login, registration, and account pages are static previews; there are no functional test accounts yet.

## Planned database entities

Users place orders; each order contains order items; each order item refers to a book; and categories group books. The draft ERD includes Users, Books, Categories, Orders, and OrderItems: [docs/ERD.md](docs/ERD.md).

## Planned external API

The book detail page reserves a section for external book information. The API and its working integration belong to a later milestone.

## Run locally

Place the project under XAMPP's `htdocs` folder and open `http://localhost:8080/IT2001-web-programming-2026/frontend/` when Apache uses port 8080.
No database or backend service is needed for Milestone 1.

