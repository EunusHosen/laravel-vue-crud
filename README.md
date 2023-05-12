## To run the local dev environment:
Clone the repository with the following command:
```
git clone git@github.com:EunusHosen/laravel-vue-crud.git
```
### API
- Navigate to `/api` folder
- Ensure version docker installed is active on host
- Copy .env.example: `cp .env.example .env`
- Install composer packages: `composer install`
- Start docker containers `./vendor/bin/sail up` (add `-d` to run detached)
- Connect to container to run commands: `./vendor/bin/sail shell`
    - Make sure you are in the `/var/www/html` path
    - Setup app key: `php artisan key:generate`
    - Migrate database: `php artisan migrate`
    - Seed database: `php artisan db:seed`
    - Run tests: `php artisan test`
- Visit api: `http://localhost`

### Frontend
- Navigate to `/frontend` folder
- Install javascript dependencies: `npm install`
- Run frontend: `npm run dev`
- Visit frontend: `http://localhost:5173`
