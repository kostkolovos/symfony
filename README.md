## Build Production
Create a .env.local file like the .env file and change the `APP_ENV=prod`.
After that all the time run the `composer install --no-dev --optimize-autoloader` command.

## Build Developing
Reads from .env file . Run `composer install --dev --optimize-autoloader` command.
