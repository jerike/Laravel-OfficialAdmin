# Laravel-Admin
Laravel 後台樣版

## Coding style

### Variable
* sepereated by _

* naming

| type      | naming          |
|-----------|-----------------|
|object     | user            |
|collection | users           |
|collection | news_collection |
|array      | user_arr        |
|string     | user_str        |
|json       | user_json       |

### Indent
* 4 spaces

### Route & Controller Methods
* [Base on RESTful Resource Controllers](http://laravel.com/docs/5.1/controllers#restful-resource-controllers)


* 新增專案，xxx 為網站名稱

```
composer create-project jerike/laravel-officialadmin --prefer-dist admin.official.tw
```

### 專案設定

* 建立 .env 檔

```
cp .env.example .env
```

* 設定 .env 檔

* 建立資料表

```
php artisan migrate
```

* 建立測試資料(本機整合測試使用)

```
> php artisan db:seed
```

* 修改專案 readme.md

