# Laravel Module Generator

A simple and customizable **Laravel Module Generator** package to help you rapidly scaffold modular components in your Laravel application.

> 🚀 Speed up your Laravel development with structured and reusable modules!

## 📦 Features

- Generate Laravel modules with MVC structure
- Supports custom namespaces and folder structures
- Command-line driven module creation
- Easily extendable for your project’s architecture

## 📁 Example Module Structure

```
modules/
├── Blog/
│   ├── Controllers/
│   ├── Models/
│   ├── Views/
│   └── routes.php
```

## 🛠 Installation

1. Clone the repository:
   ```bash
   git clone git@github.com:jmrashed/laravel-module-generator.git
   ```

2. Navigate into the project directory:
   ```bash
   cd laravel-module-generator
   ```

3. Install dependencies (if applicable via Composer):
   ```bash
   composer install
   ```

4. Publish configuration (if this is a Laravel package):
   ```bash
   php artisan vendor:publish --tag=module-generator-config
   ```

## ⚙️ Usage

You can generate a new module by running:

```bash
php artisan make:module Blog
```

This will create a new module with the necessary structure under the `modules/` directory.

### Optional Flags

- `--with-model`: Create a model with the module
- `--api`: Generate API resources (Controller + Routes)
- `--force`: Overwrite existing module

## 🧪 Testing

You can run tests (if available):

```bash
php artisan test
```

or

```bash
vendor/bin/phpunit
```

## 📄 Configuration

You can customize:
- Module path
- Namespace
- Folder structure

Update the `config/module-generator.php` file as needed after publishing.

## 🤝 Contributing

Contributions are welcome! Please fork the repo and submit a pull request.

1. Fork the repository
2. Create your branch (`git checkout -b feature/my-feature`)
3. Commit your changes (`git commit -am 'Add some feature'`)
4. Push to the branch (`git push origin feature/my-feature`)
5. Create a new Pull Request

## 📃 License

This project is licensed under the MIT License — see the [LICENSE](LICENSE) file for details. 