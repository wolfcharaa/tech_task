# Разворот небольшого API сервера с реализованной работой по пользователю

## Установка проекта

```
git clone https://github.com/wolfcharaa/tech_task.git
```

```php
composer install
```

После скачивания проекта, следует указать подключение к базе в .env файле

**Обновление базы данных**
```
php bin/console doctrine:migrations:migrate
```

Конфигурация для nginx
```
server {
    listen 80;
    listen [::]:80;
    root /home/$USER/project/www/project/tech_task/public;
    index index.php index.html index.htm;
    server_name tech_task.ru;
    location ~ ^/storage/(.*)(/.*) {
        add_header Access-Control-Allow-Origin "*";
        try_files /storage/$1$2 /storage/$1 /index.php?$query_string;
    }
    location / {
        #try_files $uri $uri/ =404;
        try_files $uri $uri/ /index.php?$query_string;
    }
    access_log /home/$USER/project/log/nginx/elsa-tech-task-access.log;
    error_log  /home/$USER/project/log/nginx/elsa-tech-task-error.log;
    location  ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/home/$USER/project/run/php/php8.1-fpm.sock;
        include fastcgi_params;
        fastcgi_send_timeout 900;
        fastcgi_read_timeout 900;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
   }
}
```

#### API методы для работы с пользователями

___GET___
`http://tech_task.ru/api/{user}/user`

___DELETE___
`http://tech_task.ru/api/{user}/user`

___POST___
`http://tech_task.ru/api/user`
```json
{
	"age": 13,
	"sex": 1,
	"email": "mara@mail.ru",
	"phone": 89111469035,
	"birthday": "2000-01-01",
	"name": "roman"
}
```

___PUT___
`http://tech_task.ru/api/{user}/user`
```json
{
	"age": 14,
	"sex": 2,
	"email": "masha@mail.ru",
	"phone": 89898465243,
	"birthday": "2003-01-01",
	"name": "masha"
}
```