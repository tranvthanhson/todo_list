# To do list

### Prerequisite
- Server Apache2 or Nginx
- PHP >= 7.3
- Composer >= 2.0.13
- Mysql >= 14
    
### Install
Clone project:
```
git clone https://github.com/tranvthanhson/todo_list
```
Create database struct:
- Access mysql and create database name `todolist`
- Import DB in "others/migrate.sql"
- Set up database connection in `config.php`

Install
- Install packages
```
composer install
```
- Serve:
```
php -S localhost:{port}
```
- Access browser with domain: `http://localhost:{port}`

### Test
Use ngrok to test (`cd others/ngrok`)
```
./ngrok http {port}
```

Change `base_uri` in Test class

Run command: `./vendor/bin/phpunit --filter TaskTest`
