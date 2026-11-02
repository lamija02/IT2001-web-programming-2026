# OnlineBookstore

OnlineBookstore is a static bookstore interface for browsing books and categories.

## Milestone 2

The MySQL schema and sample data are in [database/online_bookstore.sql](database/online_bookstore.sql). The PDO data access layer has a shared `BaseDao` and DAOs for Users, Books, Categories, Orders, and OrderItems. Routes, services, and frontend/database integration are not part of this milestone.

## Database entities and relationships

Users place orders; each order contains order items; each order item refers to a book; and categories group books. The schema has Users, Books, Categories, Orders, and OrderItems: [docs/ERD.md](docs/ERD.md).


## Run locally

1. Place the project under XAMPP's `htdocs` folder.
2. Start MySQL and import `database/online_bookstore.sql` once with phpMyAdmin.
3. Copy `backend/config/config.example.php` to `backend/config/config.php` and set the local database credentials there. The local `config.php` is ignored by Git.
4. Run `php backend/dao/test.php` from the project root to verify the DAO methods.
5. Open `http://localhost:8080/IT2001-web-programming-2026/frontend/` when Apache uses port 8080.

The storefront remains a static preview; the DAO classes are not connected to frontend pages or API routes in Milestone 2.

