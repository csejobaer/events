# Event Management System
Event Management System 🎉
A Core PHP-based event management system that allows admins to create and manage events, while users can register and book tickets.

Key Features
✅ Admin Dashboard – Manage events, users, and bookings.
✅ Event Posting – Create, edit, and delete event details.
✅ User Registration – Attendees can sign up and book events.
✅ Ticket Management – Users receive booking confirmations.
✅ T-Shirt Selection – Users can select their T-shirt size during ticket purchase.

Tech Stack
🔹 Backend: PHP (Core PHP, MySQL)
🔹 Frontend: HTML, CSS, JavaScript (Bootstrap)
🔹 Database: MySQL




## Installation Guide

### Prerequisites
Before setting up the project, ensure you have the following installed on your system:
- **XAMPP** (for Apache, MySQL, PHP) or **LAMP/WAMP/MAMP** depending on your OS.
- **PHP 7.x or 8.x**
- **MySQL 5.7 or later**
- **Git** (optional but recommended)

### Step 1: Clone the Repository
```bash
git clone https://github.com/csejobaer/events.git
cd events
```

### Step 2: Configure the Database
1. Open **phpMyAdmin** (or MySQL CLI) and create a new database:
   ```sql
   CREATE DATABASE event_management;
   ```
2. Import the database from the `sql` folder:
   - Open **phpMyAdmin**, select the `event_management` database.
   - Click **Import** and select the `events/sql/event_management.sql` file.
   - Click **Go** to execute the import.

### Step 3: Configure Database Connection
Since this is a **Core PHP** project, update the database 
```php
$host = 'localhost';
$dbname = 'event_management';
$username = 'root';
$password = '';


### Step 4: Start the Server
- Move the `events` folder to the XAMPP `htdocs` directory.
- Start **Apache** and **MySQL** from the XAMPP control panel.
- Access the project at:
```
http://localhost/events
```

### Step 5: Admin Login Credentials
- **Username:** `admin1`
- **Password:** `admin@Example1`

### Troubleshooting
- If facing database connection issues, check your MySQL credentials in `config.php`.
- Ensure MySQL service is running in XAMPP.

---
Now you're ready to use the **Event Management System** locally! 🚀

