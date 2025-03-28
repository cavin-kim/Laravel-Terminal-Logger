**`laravel-terminal-logger`**:

---

# Laravel Terminal Logger

A lightweight Laravel package to log HTTP requests, responses, database queries, and rendered views directly to the terminal or log files.

## Features
- Logs detailed HTTP requests (method, URL, headers, body).
- Logs HTTP responses (status code, content).
- Logs all database queries with execution time.
- Logs rendered views with associated data.
- Easy installation and configuration.

## Installation

1. Install the package via Composer:
   ```bash
   composer require yourvendor/laravel-terminal-logger
   ```

2. Publish the configuration file:
   ```bash
   php artisan vendor:publish --tag=config
   ```

3. Start your Laravel server:
   ```bash
   php artisan serve
   ```
## Configuration

You can customize logging behavior by editing `config/terminal-logger.php`:
```php
return [
    'log_requests' => true,
    'log_responses' => true,
    'log_queries' => true,
    'log_views' => true,
];
```

## Usage

Once installed, the package will automatically log everything based on your configuration. No additional setup is required.

## Support

If you encounter any issues or have suggestions, feel free to open an issue on the [GitHub repository](https://github.com/cavin-kim/laravel-terminal-logger).

---