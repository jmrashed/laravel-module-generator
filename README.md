# Laravel Module Generator

[![Latest Version](https://img.shields.io/packagist/v/jmrashed/laravel-module-generator.svg?style=flat-square)](https://packagist.org/packages/jmrashed/laravel-module-generator)
[![Build Status](https://img.shields.io/github/actions/workflow/status/jmrashed/laravel-module-generator/ci.yml?branch=main)](https://github.com/jmrashed/laravel-module-generator/actions)
[![Total Downloads](https://img.shields.io/packagist/dt/jmrashed/laravel-module-generator.svg?style=flat-square)](https://packagist.org/packages/jmrashed/laravel-module-generator)
[![Test Status](https://img.shields.io/github/workflow/status/jmrashed/laravel-module-generator/CI)](https://github.com/jmrashed/laravel-module-generator/actions)
[![License](https://img.shields.io/packagist/l/jmrashed/laravel-module-generator.svg?style=flat-square)](LICENSE)

> 🚀 A simple and flexible Laravel package to scaffold modular components with ease and speed.

The **Laravel Module Generator** helps you quickly create fully structured, reusable modules within your Laravel projects — perfect for organizing large applications and promoting clean architecture.

---

## 📚 Table of Contents

- [Features](#-features)
- [Installation](#-installation)
- [Configuration](#-configuration)
- [Usage](#-usage)
  - [Basic Usage](#basic-usage)
  - [Available Options](#available-options)
  - [Real-World Example](#real-world-example)
- [Testing](#-testing)
- [Contributing](#-contributing)
- [License](#-license)

---

## ✨ Features

- 📦 Generate Laravel modules with MVC structure
- 🔧 Supports custom namespaces and folder structures
- 🧰 Command-line driven with Artisan commands
- 🔌 Easily customizable and extendable
- 🗂 Keeps your Laravel app clean, modular, and maintainable

---

## 🛠 Installation

### Via Composer

```bash
composer require jmrashed/laravel-module-generator --dev
```

> Alternatively, you can clone this repository:

```bash
git clone git@github.com:jmrashed/laravel-module-generator.git
cd laravel-module-generator
composer install
```

---

### Publish Configuration (Optional)

```bash
php artisan vendor:publish --tag=module-generator-config
```

This will create a `config/module-generator.php` file where you can customize module settings.

---

## ⚙️ Configuration

You can customize the following in `config/module-generator.php`:

- Base modules path (default: `modules/`)
- Default namespace
- Folder structure (e.g., Controllers, Models, Views, etc.)
- Custom routing configurations
- Middleware and service provider setups

This allows you to adapt the package to fit your project’s architecture standards.

---

## 🚀 Usage

### Basic Usage

To generate a new module, run:

```bash
php artisan make:module Blog
```

This will scaffold the module with default folders and routing files under `modules/Blog`.

### Available Options

| Option         | Description                                       |
|----------------|---------------------------------------------------|
| `--with-model` | Also create a model class for the module          |
| `--api`        | Generate an API-ready module (Controller + Routes)|
| `--force`      | Overwrite module if it already exists             |

### Real-World Example

To create an **API** module with a **Blog** model, simply run:

```bash
php artisan make:module Blog --with-model --api
```

This will create a `Blog` module under `modules/Blog/` with:

- `BlogController.php`
- `Blog.php` model
- `api.php` routes

Example structure:

```
modules/
└── Blog/
    ├── Controllers/
    │   └── BlogController.php
    ├── Models/
    │   └── Blog.php
    ├── Routes/
    │   └── api.php
    └── Views/
        └── index.blade.php
```

---

## 🧪 Testing

To run tests:

```bash
php artisan test
```

Or directly with PHPUnit:

```bash
vendor/bin/phpunit
```

---

## 🤝 Contributing

We welcome contributions! If you'd like to contribute, please follow these steps:

1. **Fork** the repository
2. **Create** your branch (`git checkout -b feature/your-feature-name`)
3. **Commit** your changes (`git commit -am 'Add some feature'`)
4. **Push** to the branch (`git push origin feature/your-feature-name`)
5. **Create a Pull Request**

Please ensure that your code follows [PSR-12](https://www.php-fig.org/psr/psr-12/) coding standards and includes tests for new features.

For more detailed guidelines, please check the [CONTRIBUTING.md](CONTRIBUTING.md) file.

---

## 📃 License

This package is open-source software licensed under the [MIT license](LICENSE).

---

## 🙌 Acknowledgements

Built with ❤️ by [Md Rasheduzzaman](https://rasheduzzaman.com).  
Follow me on [GitHub](https://github.com/jmrashed) or [Twitter](https://twitter.com/_rasheduzzaman) for more Laravel goodies. 