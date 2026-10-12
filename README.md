# Laravel Inventory

An inventory management web application built with Laravel.
It handles suppliers, customers, products, purchases, invoices, payments and stock, with printable reports.

**Live demo:** <https://laravel-inventory.davidebalice.dev/>

Demo credentials: `mario@rossi.it` / `12345678`

![Screenshot](https://www.aroundweb.it/screenshot/inventory.jpg)

## Features

- Authentication (Laravel Breeze): login, registration, password reset, email verification
- Admin profile with photo upload and password change
- Suppliers, customers, units, categories and products management
- Purchases with approval workflow and pending list
- Invoices with approval, payments (full paid, partially paid, full due) and printable invoice
- Customer credit and paid reports, customer-wise reports
- Daily purchase and invoice reports
- Stock report, supplier-wise and product-wise stock reports
- Printable report pages
- English and Italian interface
- Demo mode that blocks create, update and delete actions

## Tech stack

- [Laravel 9](https://laravel.com/) (PHP 8)
- [Laravel Breeze](https://laravel.com/docs/starter-kits) authentication
- [Intervention Image](https://image.intervention.io/)
- MySQL
- Blade templates, Bootstrap admin theme, jQuery
- [Vite](https://vite.dev/), [Tailwind CSS](https://tailwindcss.com/) and [Alpine.js](https://alpinejs.dev/) (auth pages)

## Getting started

### Requirements

- PHP 8.0.2 or later
- Composer
- Node.js and npm
- MySQL or MariaDB

### Installation

```bash
git clone https://github.com/davidebalice/laravel-inventory.git
cd laravel-inventory
composer install
npm install
cp .env.example .env
php artisan key:generate
```

### Configuration

Set the database connection in `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

Optional:

| Variable    | Description                                      |
| ----------- | ------------------------------------------------ |
| `DEMO_MODE` | `true` to block create/update/delete actions     |

Then create the tables and link the storage folder:

```bash
php artisan migrate
php artisan storage:link
```

### Run

```bash
npm run build      # or: npm run dev
php artisan serve
```

Open <http://localhost:8000> and register a new user.

## Main routes

| Route                     | Description                         |
| ------------------------- | ----------------------------------- |
| `/dashboard`              | Dashboard                           |
| `/suppliers`              | Suppliers                           |
| `/customers`              | Customers                           |
| `/units`, `/categories`   | Units and categories                |
| `/products`               | Products                            |
| `/purchase`               | Purchases                           |
| `/invoices`               | Invoices                            |
| `/credit/customer`        | Customers with credit               |
| `/paid/customer`          | Paid customers                      |
| `/stock/report`           | Stock report                        |
| `/admin/profile`          | Admin profile                       |

All routes are defined in `routes/web.php` and require authentication.

## Author

**Davide Balice** – [davidebalice.dev](https://www.davidebalice.dev)
