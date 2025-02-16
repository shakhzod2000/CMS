# CMS

A lightweight and customizable Content Management System (CMS) built with PHP and MySQL.

## Features
- User authentication and management
- Article and page creation
- Simple and clean admin panel
- Easy installation and setup

## Requirements
Before installing, make sure your server meets the following requirements:
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache or Nginx
- Composer

## Installation

### 1. Clone the repository
```sh
git clone https://github.com/shakhzod2000/CMS.git
cd CMS
```

### 2. Install dependencies
```sh
composer install
```

### 3. Configure the database
Create a new MySQL database and update the `.env` file with your database credentials:
```env
DB_HOST=localhost
DB_NAME=cms
DB_USER=root
DB_PASSWORD=yourpassword
```

### 4. Import the database schema
Run the following command to import the database structure:
```sh
mysql -u root -p cms_database < database.sql
```

### 5. Set up file permissions
Make sure the `uploads` and `cache` directories are writable:
```sh
chmod -R 777 uploads cache
```

### 6. Start the server
If using PHP's built-in server:
```sh
php -S localhost:8000
```
Then visit `http://localhost:8000` in your browser.

## Usage
- Login to the admin panel at `http://localhost:8000/route=admin/login`
- Default credentials:
  - **Login:** `admin`
  - **Password:** `top-secret`
- Create and manage articles and pages from the dashboard

## Contributing
Contributions are welcome! Feel free to fork the repository and submit pull requests.

## Contact
For questions or support, open an issue or contact me at [GitHub](https://github.com/shakhzod2000).
