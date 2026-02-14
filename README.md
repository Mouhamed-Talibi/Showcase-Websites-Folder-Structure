# FolderStructureBase

A clean, simple, and well-organized PHP MVC framework with modern front-end tooling. This project showcases a professional folder structure for building scalable web applications.

## 📋 Table of Contents

- [Features](#features)
- [Project Structure](#project-structure)
- [Requirements](#requirements)
- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
- [Available Scripts](#available-scripts)
- [Directory Overview](#directory-overview)
- [License](#license)

## ✨ Features

- **MVC Architecture** - Clean separation of concerns with Models, Views, and Controllers
- **Custom Router** - Simple and powerful routing system with support for HTTP methods (GET, POST, etc.)
- **Tailwind CSS** - Utility-first CSS framework for rapid UI development
- **Error Handling** - Built-in exception handling with custom error pages
- **Database Abstraction** - Clean database layer for easy data management
- **Logging System** - Structured logging for debugging and monitoring
- **PostCSS Support** - Modern CSS processing with autoprefixer

## 📁 Project Structure

```
FolderStructureBase/
├── app/
│   ├── Controllers/          # Application controllers
│   │   └── HomeController.php
│   ├── Core/                # Core framework classes
│   │   ├── Database.php     # Database abstraction layer
│   │   ├── Logger.php       # Logging utility
│   │   ├── Router.php       # Routing system
│   │   └── View.php         # View renderer
│   ├── Exceptions/          # Custom exceptions
│   │   ├── AppException.php
│   │   └── NotFoundException.php
│   ├── Models/              # Data models
│   └── Views/               # View templates
│       ├── errors/          # Error pages (404, 500)
│       ├── includes/        # Reusable template parts
│       ├── layouts/         # Layout templates
│       └── pages/           # Page templates
├── config/                  # Configuration files
│   ├── app.php             # Application configuration
│   └── database.php        # Database configuration
├── public/                 # Web root (publicly accessible)
│   ├── index.php          # Application entry point
│   └── assets/            # Static assets
│       ├── css/           # Stylesheets
│       ├── js/            # JavaScript files
│       └── images/        # Image files
├── routes/                # Route definitions
│   └── web.php           # Web routes
├── storage/              # Application storage
│   └── logs/            # Application logs
├── vendor/              # Composer dependencies
├── composer.json        # PHP dependencies
├── package.json         # Node dependencies
├── tailwind.config.js   # Tailwind CSS configuration
└── postcss.config.js    # PostCSS configuration
```

## 🔧 Requirements

- **PHP** >= 7.4
- **Node.js** >= 12.0 (for Tailwind CSS)
- **Composer** (for PHP dependency management)
- **npm** or **yarn** (for Node dependencies)

## 📦 Installation

### 1. Clone the Repository

```bash
git clone https://github.com/Mouhamed-Talibi/Showcase-Websites-Folder-Structure.git
cd FolderStructureBase
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install Node Dependencies

```bash
npm install
```

### 4. Configure Your Application

Create a `.env` file or update the configuration files:

```bash
# config/app.php    - Application settings
# config/database.php - Database connection
```

## ⚙️ Configuration

### Application Configuration

Edit `config/app.php` to set up your application:
- Error reporting levels
- Server protocol and host
- Application paths

### Database Configuration

Edit `config/database.php` to configure your database connection:
- Host
- Database name
- Username and password

## 🚀 Usage

### Starting the Application

1. **Set up your web server** to point the document root to the `public/` directory
2. **Access your application** through your browser (e.g., `http://localhost`)

### Defining Routes

Edit `routes/web.php` to define your application routes:

```php
<?php
use App\Core\Router;

$router->get('/', 'HomeController@index');
$router->post('/signup', 'HomeController@signup');
```

### Creating Controllers

Create controller classes in `app/Controllers/` and implement your business logic:

```php
<?php
namespace App\Controllers;

class YourController
{
    public function yourMethod()
    {
        // Your logic here
    }
}
```

### Creating Views

Create view files in `app/Views/pages/` and render them from controllers:

```php
view('pages.your-page', $data);
```

## 📝 Available Scripts

### Frontend Development

```bash
# Watch and compile Tailwind CSS (development mode)
npm run dev

# Build and minify Tailwind CSS (production mode)
npm run build
```

## 📚 Directory Overview

| Directory | Purpose |
|-----------|---------|
| `app/Core/` | Core framework classes (Router, Database, Logger, View) |
| `app/Controllers/` | Application business logic |
| `app/Models/` | Data models for database interaction |
| `app/Views/` | HTML templates and layout files |
| `app/Exceptions/` | Custom exception classes |
| `public/` | Web-accessible files and entry point |
| `config/` | Application configuration files |
| `routes/` | Route definitions for your application |
| `storage/` | Application-generated files (logs, cache, etc.) |
| `vendor/` | Composer-managed dependencies |

## 🛠️ Development Workflow

1. **Define Routes** in `routes/web.php`
2. **Create Controllers** in `app/Controllers/`
3. **Create Models** in `app/Models/` (optional)
4. **Build Views** in `app/Views/`
5. **Watch CSS** with `npm run dev`
6. **Test & Deploy**

## 🤝 Contributing

Contributions are welcome! Feel free to:
- Report issues
- Submit pull requests
- Suggest improvements

## 📄 License

This project is licensed under the ISC License. See the LICENSE file for details.

---

**Happy Coding!** 🎉

For more information, visit the [GitHub repository](https://github.com/Mouhamed-Talibi/Showcase-Websites-Folder-Structure).
