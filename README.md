# JBOOK - PHP User Registration System

JBOOK is a simple PHP-based sample website that demonstrates how to register users with a username and password, sanitize inputs to prevent common web attacks, and store user information securely in a MySQL database using hashed passwords.

This project is powered by **XAMPP**, using **Apache** for the server and **MySQL** for the database. It is a basic demonstration of how server-side form handling and database interaction works using HTML, PHP, and MySQL.

## 🔒 Security Features

- Sanitization using `filter_input()` to avoid XSS and injection attacks
- `password_hash()` for secure password storage
- Prepared statements using `mysqli` to prevent SQL injection
- Form method set to `POST` to keep credentials out of the URL

## 🧰 Technologies Used

- PHP
- HTML5
- MySQL
- XAMPP (Apache + MySQL)

## 📁 Project Structure

project-root/
│
├── sample_database.php # Handles DB connection securely
├── jbook.php # Handles user registration


## ⚙️ How to Run Locally

1. **Install XAMPP**  
   Download and install XAMPP: https://www.apachefriends.org/

2. **Start Apache and MySQL**  
   Open the XAMPP Control Panel and start both **Apache** and **MySQL**.

3. **Create the Database**  
   Open **phpMyAdmin** or use MySQL CLI to create your database and `users` table:
   ```sql
   CREATE DATABASE your_db_name;

   USE your_db_name;

   CREATE TABLE users (
     id INT AUTO_INCREMENT PRIMARY KEY,
     user VARCHAR(255) UNIQUE,
     password VARCHAR(255)
   );


# Update Credentials
In sample_database.php, replace:

$db_server = "YOUR_SERVER";
$db_user = "YOUR_USER";
$db_pass = "YOUR_PASS";
$db_name = "YOUR_NAME";

with your actual DB credentials or pull them from .env (optional security enhancement).

# Run the Project
Place the project folder in htdocs/ (inside your XAMPP installation) and visit:
http://localhost/your_project_folder/

Register Users
Fill in the username and password fields to register new users. If the username already exists, an error is shown.

# 📌 Notes
This is a simplified version and does not include login/authentication features.

Passwords are hashed using PASSWORD_DEFAULT (currently BCRYPT).

This project is intended for learning and demonstration purposes.

# ✅ Best Practices Followed
Connection cleanup with mysqli_close()

Error handling using try-catch

Preventing code execution on page load with $_SERVER["REQUEST_METHOD"] === "POST"

📜 License
This project is open source and free to use for educational purposes.
---

