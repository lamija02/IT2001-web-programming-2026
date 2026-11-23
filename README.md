# OnlineBookstore

OnlineBookstore is a single-page bookstore application. The frontend is a static preview; the backend provides a PHP REST API backed by MySQL.

## Project structure

- `frontend/` contains the HTML, CSS, JavaScript and book cover assets.
- `backend/` contains the FlightPHP API, services, DAOs and OpenAPI documentation.
- `database/online_bookstore.sql` creates and seeds the MySQL database.

The database has five entities: users, books, categories, orders and order items. Orders are created with at least one item. The order service stores each item's unit price from the current book price and saves the order and its items in one transaction.

## Run locally

1. Place the project under XAMPP's `htdocs` folder and start Apache and MySQL.
2. Import `database/online_bookstore.sql` once with phpMyAdmin.
3. Copy `backend/config/config.example.php` to `backend/config/config.php` and set the database credentials there. The local `config.php` is ignored by Git.
4. Install the backend dependencies from the `backend/` folder:

   ```sh
   composer install
   ```

5. Open the API documentation at `http://localhost:8080/IT2001-web-programming-2026/backend/public/v1/docs/` when Apache uses port 8080.

For the PHP development server, run this from the project root after installing dependencies:

```sh
php -S localhost:8000 -t backend backend/index.php
```

The local API base URL is `http://localhost:8000/`. Its Swagger page is `/public/v1/docs/`.

## API routes

| Method | Route | Purpose |
| --- | --- | --- |
| GET, POST | `/books` | List or create books |
| GET, PUT, DELETE | `/books/{id}` | Read, update or delete a book |
| GET, POST | `/categories` | List or create categories |
| GET, PUT, DELETE | `/categories/{id}` | Read, update or delete a category |
| GET, POST | `/users` | List or create users |
| GET, PUT, DELETE | `/users/{id}` | Read, update or delete a user |
| GET, POST | `/orders` | List orders or create an order with items |
| GET, PUT, DELETE | `/orders/{id}` | Read, update or delete an order |
| GET, POST | `/orders/{id}/items` | List or add items in an order |
| GET | `/order-items` | List order items |
| GET, PUT, DELETE | `/order-items/{id}` | Read, update the quantity or delete an order item |
| GET | `/dashboard` | Read bookstore totals |
| GET | `/external/books?q=...` | Search Open Library for book information |

Successful reads and updates return HTTP 200, creates return 201, validation errors return 400, missing records return 404, and external service failures return 503. Errors use a JSON object with `status` and `error` fields; unexpected server errors are recorded under `backend/logs/` and return a generic message.

The Open Library search runs through the backend with a timeout. The route returns selected book details for a later frontend feature. The frontend remains static in Milestone 3; backend integration is scheduled for Milestone 4.

## Authentication

The API currently has no authentication or role checks. JWT authentication and authorization belong to a later milestone.
