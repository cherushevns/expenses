## Init

```bash
cp .env.example .env
```

```bash
docker-compose up -d --build
```

```bash
docker-compose exec php /bin/bash
```

```bash
composer install
```

```bash
php vendor/bin/phinx migrate
```

## Broke something? Try:
```bash
docker-compose down; docker-compose kill;
```

```bash
docker rm --force $(docker ps -aq)
```

```bash
docker system prune -a -f 
```

```bash
docker-compose up -d --build
```