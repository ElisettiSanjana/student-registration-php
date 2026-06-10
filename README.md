# Student Registration System
A full-stack CRUD web application built with PHP, MySQL, and Bootstrap.

## Tech Stack
- **Frontend**: HTML, CSS, Bootstrap 5
- **Backend**: PHP (OOP with PDO)
- **Database**: MySQL
- **Architecture**: MVC-inspired (Model + View separated)

## Features
- Register new students (Create)
- View all registered students (Read)
- Edit student details (Update)
- Delete student records (Delete)
- Input validation and sanitization
- Responsive UI with Bootstrap 5

## Project Structure
```
php-project/
├── config/
│   └── db.php          # OOP Database connection class
├── models/
│   └── Student.php     # Student CRUD model class
├── index.php           # Main page (Register + List)
├── edit.php            # Edit student record
├── database.sql        # MySQL schema
└── README.md
```

## Setup Instructions
1. Install [XAMPP](https://www.apachefriends.org/) or WAMP
2. Copy this project folder to `htdocs/`
3. Open **phpMyAdmin** → import `database.sql`
4. Start Apache + MySQL in XAMPP
5. Open browser → `http://localhost/php-project/`

## Skills Demonstrated
- PHP OOP (Classes, Methods, Constructor)
- PDO prepared statements (SQL injection prevention)
- MySQL CRUD operations
- Bootstrap 5 responsive design
- MVC-style code organization
- Input sanitization with `htmlspecialchars()`
- <img width="1866" height="943" alt="image" src="https://github.com/user-attachments/assets/659e3ed8-d004-4002-8b98-fc2951c642bf" />

