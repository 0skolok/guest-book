# guest-book

Способ установки:
+ Скачать репозиторий и разархивировать его в папку "guest-book" локального сервера
+ Через консоль (OpenServer) перейти в папку guest-book/application и прожать ``` composer install ```
+ Создать базу данных "guest_book"
+ Через консоль (OpenServer) перейти в папку guest-book и набрать ``` php index.php cr_database deploy ```
- Если установлен другой путь или порт изменениям подвергаются файлы application/config/config.php, assets/script/*
