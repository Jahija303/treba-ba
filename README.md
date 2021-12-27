# Login Info

## Admin

```
email: admin@treba.ba
password: password
```

## User

```
email: user@treba.ba
password: password
```

# Setup

## Initial repo cloning & setting up .env file

### Github
```bash
gh repo clone Jahija303/treba-ba
cd treba-ba
```

### .env file
```bash
cp .env.example .env
```

- Create an empty database for this application
- In the .env file, add database information to allow Laravel to connect to the database
- Fill in the DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, and DB_PASSWORD

## Setup dependencies and migrate the database

```bash
composer install
npm install
php artisan key:generate
php artisan migrate:fresh --seed
```
