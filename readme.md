# Stechs App

Api Rest to manage Cablemodem And Models. Fontend build in Vuejs and Bootstrap (webpack) and Backend PHP-Mysql.

## Installation Back

1.In back folder run, edit settings.php with data connetion:

```bash
<?php
define('DB_DRIVER','mysql');
define('DB_HOST','localhost');
define('DB_NAME','');
define('DB_USER','');
define('DB_PASS','');
define('DB_PORT','3306');
```
2.In back folder run: 
```bash
composer install
```

3.In back folder run:
```bash
php -S localhost:8002 index.php
```

## Installation Front

1.In front folder run:

```bash
npm install
```
2.Edit apiHost constant in src/config.js with Api Base Url
```bash
export const apiHost = 'http://localhost:8002/'
```

2.In front folder run
```bash
npm run start
```
