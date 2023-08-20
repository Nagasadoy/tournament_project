start:
	cd docker && echo "HELLO" && \
 	docker compose build && \
	docker compose up -d && \
	docker compose exec php bash && \
	composer install && \
	php bin/console d:m:migrate

start-old-docker-compose:
	cd docker && echo "HELLO" && \
	docker-compose build && \
	docker-compose up -d && \
	docker-compose exec php bash && \
	composer install && \
	php bin/console d:m:migrate