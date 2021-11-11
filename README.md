# Start
```bash
docker-compose up -d --build
```
# Install

```bash
# Edit enviroment
cp .env.example .env
sudo vi .env
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
sudo docker-compose exec app composer install
sudo docker-compose exec app php artisan key:generate
sudo docker-compose exec app php artisan config:clear
sudo docker-compose exec app php artisan config:cache
sudo docker-compose exec app php artisan optimize
sudo docker-compose exec app php artisan storage:link
```
```bash
sudo docker-compose exec app npm install
sudo docker-compose exec app npm run dev
```

# Database
```bash
# Migrate
sudo docker-compose exec app php artisan migrate

# Seeder
sudo docker-compose exec app php artisan db:seed
```