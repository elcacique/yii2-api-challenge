## Clone repo
```
git clone git@github.com:elcacique/yii2-api-challenge.git
```

## Install
```
cd yii2-api-challenge
cp .env.example .env
docker compose up -d
docker compose run composer install
```

## Run migrations
```
docker compose exec -it php ./yii migrate
```

## Run Seeders
```
docker compose exec -it php ./yii seeder/make-users
docker compose exec -it php ./yii seeder/make-albums
docker compose exec -it php ./yii seeder/make-photos
```

## Run tests
```
docker compose exec -it php ./vendor/bin/codecept run
```

## Delete demo data
```
docker compose exec -it php ./yii seeder/clean
```

## Stop docker containers
```
docker compose down
```
