#Installation

Set up `NEWSAPI_API_KEY` to the `.env`
```
export WWWUSER=${WWWUSER:-$UID} && export WWWGROUP=${WWWGROUP:-$(id -g)}

docker-compose up -d
```

Inside of `api` container:
```
php artisan migrate
```
