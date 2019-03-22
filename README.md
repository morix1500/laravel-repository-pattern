## 起動方法

```
$ mv .env-local .env

# 起動
$ docker-compose up -d

# localhost:8000 で閲覧できる
```

## Memo

```
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

# Twig Install
$ composer require rcrowe/twigbridge
$ php artisan vendor:publish --provider="TwigBridge\ServiceProvider"

# Request作成
$ php artisan make:request TaskRequest
```
