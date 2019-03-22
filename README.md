
```
$ vim .env

# composer
$ composer require predis/predis

# テーブル作成
$ php artisan make:migration create_tasks_table --create=tasks
$ php artisan migrate

# モデル作成
$ mkdir -p app/Models
$ mv app/User.php app/Models/.
$ php artisan make:model Models/Task

# Controller作成
$ php artisan make:controller TaskController

# 認証用意
$ php artisan make:auth

$ Service作成
$ mkdir app/Services

$ Repository作成
$ mkdir app/Repositories
```
