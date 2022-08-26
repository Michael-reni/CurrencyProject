### Open terminal. Every command that needs to be executed in terminal starts with number and a dot

### Laravel project lies in laravel_project/laravel. I recommend to open it in some IDE like Visual Studio Code right now
### Create .env file from .env.example u can change DB_NAME and DB_PASSWORD but dont change value of DB_USERNAME, DB_HST, DB_PORT
1. cd path/to/project/CurrencyProject
2. docker-compose --env-file ./laravel_project/laravel/.env  up -d
3. docker exec -it nginx_currency_project bash
### no we need to setup CRON entry
4. crontab -e
### Now click "i" to acces insert mode, and write this beneth comments "* * * * * cd app/laravel && /usr/local/bin/php artisan scheduler:run >> cron_file.txt"
### next click ESC to escape insert mode and write :wq to save cron tab entry
5. cd app/laravel
6. php artisan migrate
7. php artisan migrate --path=database/migrations/currency_project
### now apllication works if you acces database u can acces container phpmyadming in browser on localhost:8081 
### to login use 'mysql_currency_project' as SERWER 'root' as user and DB_PASSWORD from .env ad passwor
### u can also requst this endpoint  http://127.0.0.1:8080/api/currency to get paginated data from the database
