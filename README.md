# ninjam-configurator

1. Clone Repo
2. Run `composer install`
3. Run `npm install`
4. Create `.env` file from `.env.example`
5. Update `.env` with ninjam config file path, and service commands to start, stop, restart, and status ninjam
6. Update `.env` with database and other info
7. Run `php artisan migrate`
8. Run `npm run build`
9. Add yourself to user seed and run `php artisan seed`

*This is a very basic proof-of-concept, so use it at your own risk, it's not supported*
