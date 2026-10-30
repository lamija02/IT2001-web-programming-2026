SET NAMES utf8mb4;

CREATE DATABASE IF NOT EXISTS online_bookstore
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE online_bookstore;

CREATE TABLE IF NOT EXISTS users (
    user_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(120) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS categories (
    category_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(80) NOT NULL UNIQUE,
    description VARCHAR(255) NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS books (
    book_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(180) NOT NULL,
    author VARCHAR(120) NOT NULL,
    description TEXT NULL,
    price DECIMAL(10, 2) UNSIGNED NOT NULL,
    rating DECIMAL(3, 2) UNSIGNED NULL,
    category_id INT UNSIGNED NOT NULL,
    CONSTRAINT fk_books_category
        FOREIGN KEY (category_id) REFERENCES categories (category_id)
        ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS orders (
    order_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    status VARCHAR(20) NOT NULL DEFAULT 'pending',
    ordered_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_orders_user
        FOREIGN KEY (user_id) REFERENCES users (user_id)
        ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS order_items (
    order_item_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    order_id INT UNSIGNED NOT NULL,
    book_id INT UNSIGNED NOT NULL,
    quantity INT UNSIGNED NOT NULL DEFAULT 1,
    unit_price DECIMAL(10, 2) UNSIGNED NOT NULL,
    CONSTRAINT uq_order_items_order_book UNIQUE (order_id, book_id),
    CONSTRAINT fk_order_items_order
        FOREIGN KEY (order_id) REFERENCES orders (order_id)
        ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT fk_order_items_book
        FOREIGN KEY (book_id) REFERENCES books (book_id)
        ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB;

INSERT INTO users (user_id, full_name, email) VALUES
    (1, 'Demo Reader', 'reader@example.com');

INSERT INTO categories (category_id, name, description) VALUES
    (1, 'Classics', 'Classic books and enduring stories.'),
    (2, 'Fantasy', 'Fantasy novels and imaginative worlds.'),
    (3, 'Mystery', 'Mystery and crime fiction.'),
    (4, 'Historical Fiction', 'Fiction set in historical periods.');

INSERT INTO books (book_id, title, author, description, price, rating, category_id) VALUES
    (1, 'The Little Prince', 'Antoine de Saint-Exupéry', 'A classic story about friendship and discovery.', 12.99, 4.34, 1),
    (2, 'Harry Potter and the Chamber of Secrets', 'J.K. Rowling', 'The second book in the Harry Potter series.', 19.99, 4.43, 2),
    (3, 'The Girl with the Dragon Tattoo', 'Stieg Larsson', 'A journalist and a hacker investigate a disappearance.', 17.99, 4.18, 3),
    (4, 'The Shadow of the Wind', 'Carlos Ruiz Zafón', 'A reader searches for the truth behind a forgotten author.', 16.99, 4.31, 4),
    (5, 'A Tale of Two Cities', 'Charles Dickens', 'A historical novel set during the French Revolution.', 14.99, 3.88, 1);

INSERT INTO orders (order_id, user_id, status, ordered_at) VALUES
    (1, 1, 'completed', '2026-10-20 12:00:00');

INSERT INTO order_items (order_item_id, order_id, book_id, quantity, unit_price) VALUES
    (1, 1, 1, 1, 12.99),
    (2, 1, 5, 1, 14.99);
