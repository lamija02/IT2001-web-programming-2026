# OnlineBookstore draft ERD

This is the Milestone 1 planning draft. It identifies the entities and their relationships; database columns, keys, and implementation will be refined in Milestone 2.

```mermaid
erDiagram
    USERS ||--o{ ORDERS : places
    ORDERS ||--|{ ORDER_ITEMS : contains
    BOOKS ||--o{ ORDER_ITEMS : appears_in
    CATEGORIES ||--o{ BOOKS : groups

    USERS {
        int user_id
    }
    BOOKS {
        int book_id
    }
    CATEGORIES {
        int category_id
    }
    ORDERS {
        int order_id
    }
    ORDER_ITEMS {
        int order_item_id
    }
```

The five planned entities are Users, Books, Categories, Orders, and OrderItems. A user can place orders; each order contains order items; each order item refers to a book; and a category groups books.
