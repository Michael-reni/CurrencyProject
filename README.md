### Open terminal. Every command that needs to be executed in terminal starts with a number and a dot
### Laravel project lies in laravel_project/laravel. I recommend to open it in some IDE like Visual Studio Code right now
### Create .env file from .env.example 
### You can change DB_NAME and DB_PASSWORD but don't change value of DB_USERNAME, DB_HOST, DB_PORT
1. cd path/to/project/CurrencyProject
2. docker-compose --env-file ./laravel_project/laravel/.env  up -d
3. docker exec -it nginx_currency_project bash
### Now we need to setup CRON entry
4. crontab -e
### Now click "i" to access insert mode and write this beneath comments "* * * * * cd app/laravel && /usr/local/bin/php artisan schedule:run >> cron_file.txt"
### Next click ESC to escape insert mode and write :wq to save cron tab entry
5. cd app/laravel
6. composer install
7. php artisan migrate
8. php artisan migrate --path=database/migrations/currency_project
### Now aplication works. If you want to access database you can access container phpmyadmin in browser on localhost:8081 
### To login in phpmyadmin use 'mysql_currency_project' as SERWER 'root' as a user and DB_PASSWORD from .env as a password
### You can also request this endpoint  http://127.0.0.1:8080/api/currency to get paginated data from the database
