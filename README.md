# 💰 Expense Management System

A Laravel-based Dashboard and API project for managing **Vendors**, **Categories**, and **Expenses** with authentication, roles, and reports.

---

## 🚀 Features

-   **Authentication** using Laravel Passport (Admin & Staff)
-   **Role-based access**
    -   Admin → Full CRUD access
    -   Staff → Create & Read only (own expenses)
-   **CRUD APIs** for:
    -   Categories
    -   Vendors
    -   Expenses
-   **Summary Report**: Total expenses grouped by month and category
-   **Soft Deletes** supported
-   **Multi-language fields** (Arabic / English)
-   **Validation & Error Codes** (422 for validation, 403 for unauthorized)
-   **Seeder & Factory** included for testing

---

## 🧩 Tech Stack

-   **Laravel 10+**
-   **PHP 8.1+**
-   **MySQL**
-   **Passport Authentication**
-   **Spatie Permission**

---

## ⚙️ Installation Steps

1. **Clone the repository**

    ```bash
     git clone https://github.com/your-username/expense-management-system.git
     cd expense-management-system
     composer install
     cp .env.example .env
     php artisan key:generate
     php artisan migrate --seed
     php artisan passport:install
     php artisan serve


     TEST credentials
     role: admin
     api and dashboard{
         user: admin@gmail.com
         password: 123456789
     }
     role: staff
     api and dashboard{
         user: staff@gmail.com
         password: 123456789
     }
    ```
