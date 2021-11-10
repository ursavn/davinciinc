# Start
```bash
docker-compose up -d --build
```
# Install

```bash
# Edit enviroment
$ cp .env.example .env
$ sudo vi .env
```

Change the database configuration as below.
```
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=davinciinc
DB_USERNAME=root
DB_PASSWORD=davinciinc
```
Save and close.

Next, install module, generate the Laravel application key and clear the cache configuration.
```bash
$ sudo docker-compose exec app composer install
$ sudo docker-compose exec app php artisan key:generate
$ sudo docker-compose exec app php artisan config:clear
$ sudo docker-compose exec app php artisan config:cache
$ sudo docker-compose exec app php artisan optimize
```

# Database
```bash
# Migrate
docker-compose exec app php artisan migrate

# Seeder
docker-compose exec app php artisan db:seed
```