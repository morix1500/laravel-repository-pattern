
```
$ vim .env

# テーブル作成
$ php artisan make:migration create_tasks_table --create=tasks
$ php artisan migrate

# モデル作成
$ mkdir -p app/Models
$ mv app/User.php app/Models/.
$ php artisan make:model Models/Task
```
