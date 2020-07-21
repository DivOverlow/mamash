Запуск проекта на Docker
1. Запускаем divotek-proxy(Предварительно скачать)
2. Запускаем проект на Docker "bash start.sh" с папки docker в корне проекта
3. Заходим в контейнер проекта "docker exec -it drv-srv bash"
4. Переходим в папку библиотек для обновления composer "cd common/lib"
5. Выполняем "composer update"
6. возвращаемся в корень проекта "cd ../../"
7. выполняем инициализацию проекта "./init" -> "0" -> "y"
8. создаем отсутсвующие папки и запускаем повторную инициализацию
 - mkdir frontend/runtime/debug
 - mkdir frontend/www/assets
 - mkdir frontend/www/images/redactor
 - mkdir frontend/www/images/material
 *если ошибок нету, идем дальше
9. открываем в редакторе файл common/config/env.php
 - 'db'  => [
            'username'              => 'root',
            'password'              => 'password',
        ],
10. открываем в редакторе common/config/main.php
 - 'db'  => [ // DB определяется для всех типов приложения
            'connectionString'      => 'mysql:host=mysql;dbname=<имя базы>',
* для работы с базой см. ридми в divotek-proxy

Адрес сайта drovnik.divo
Адрес админки adm.drovnik.divo