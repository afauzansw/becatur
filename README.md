# Becatur

![image](https://github.com/user-attachments/assets/4b1dffdf-4cda-4229-b037-af87b7cdec91)

This is a Laravel Inertia project that utilizes Bun as the package manager and runtime for frontend dependencies.

## Requirements

- PHP >= 8.1
- Composer
- Bun (https://bun.sh/)
- Node.js (optional, if you need compatibility with Node-based tools)
- Database (MySQL, PostgreSQL, or SQLite, depending on your configuration)

## Installation

1. Clone the repository:
   ```sh
   git clone https://github.com/your-username/your-project.git
   cd your-project
   ```

2. Install backend dependencies:
   ```sh
   composer install
   ```

3. Install frontend dependencies using Bun:
   ```sh
   bun install
   ```

4. Copy the environment file and configure your settings:
   ```sh
   cp .env.example .env
   ```
   Modify `.env` as needed, including database credentials.

5. Generate the application key:
   ```sh
   php artisan key:generate
   ```

6. Run migrations and seed the database (if applicable):
   ```sh
   php artisan migrate --seed
   ```

## Running the Project

### Backend (Laravel)
Start the Laravel development server:
```sh
php artisan serve
```

### Frontend (Vite + Bun)
Run the Vite development server:
```sh
bun run dev
```

## Building for Production

For production builds, run:
```sh
bun run build
```

And make sure to optimize Laravel:
```sh
php artisan optimize
```

## Additional Commands

- To clear caches:
  ```sh
  php artisan cache:clear
  php artisan config:clear
  php artisan route:clear
  php artisan view:clear
  ```

- To run tests:
  ```sh
  php artisan test
  ```

## License
This project is open-source and available under the [MIT License](LICENSE).

