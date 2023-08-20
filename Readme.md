Для запуска приложения:
1. Необходимо чтобы на компьютере был установлен docker compose (docker-compose).
2. запустите make файл: "make start"  для новой версии docker compose, для старой запустите: "make start-old-docker-compose" или же запустите команды вручную:

* `cd docker` #перейти в папку с docker compose
* `docker compose build` # или docker-compose
* `docker compose up -d` 
* `docker compose exec php bash` #следующие команды вводить в открывшемся терминале
* `composer install`
* `php bin/console d:m:migrate`

3. когда в консоли появится сообщение о выполнении миграций, необходимо выбрать "yes"
4. перейти на localhost:8080
