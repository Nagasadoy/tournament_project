Для запуска приложения:
1. Необходимо чтобы на компьютере был установлен docker compose.
2. запустите make файл: "make start"  для новой версии docker compose, для старой запустите: "make start-old-docker-compose"
3. во время запуска команды в консоли появится сообщение о выполнении миграций, необходимо выбрать "yes"
4. перейти на localhost:8080

В случае если будут ошибки, попробовать вручную выполнить команды:
* `cd docker` #перейти в папку с docker compose
* `docker compose build` 
* `docker compose up -d` 
* `docker compose exec php bash` #следующие команды вводить в открывшемся терминале
* `composer install`
* `php bin/console d:m:migrate`

