.PHONY: init

up:
	docker-compose up

init:
	docker-compose exec --user=application app composer install
	docker-compose exec --user=application app bash -c 'php init --env=docker --overwrite=all'

migrate:
	docker-compose exec --user=application app bash -c 'php yii migrate'

migrate-fresh:
	docker-compose exec --user=application app bash -c 'php yii migrate/fresh'

seed:
	docker-compose exec --user=application app bash -c 'php yii fixture/load "*"'

stop:
	docker-compose stop

destroy:
	docker-compose down --rmi local --volumes --remove-orphans

logs:
	docker-compose logs --follow

app:
	docker-compose exec --user=application app bash

db:
	docker-compose exec mysql bash

db_allow_root:
	docker-compose exec mysql mysql -uroot -proot -e "GRANT ALL PRIVILEGES ON *.* TO 'root'@'localhost'";
	docker-compose exec mysql mysql -uroot -proot -e "UPDATE mysql.user SET host='%' WHERE user='root';";
	docker-compose restart mysql

sql:
	docker-compose exec mysql bash -c 'mysql -uroot -proot'
