start:
	cd docker && echo "HELLO" && \
 	docker compose build && \
	docker compose up -d && \
	docker compose exec php composer install && \
    docker compose exec php php bin/console d:m:migrate

start-old-docker-compose:
	cd docker && echo "HELLO" && \
	docker-compose build && \
	docker-compose up -d && \
	docker-compose exec php composer install && \
    docker-compose exec php php bin/console d:m:migrate