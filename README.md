# SimpliCMS CMS based on the Laravel Framework modular and extensible by design

## Installation

**1. Get the app**:

Either download and decompress [the zipball](https://github.com/SimpliCMS/SimpliCMS/archive/refs/heads/main.zip)
or use git:

```bash
git clone https://github.com/SimpliCMS/SimpliCMS.git
```

**2. Install Dependencies**:

```bash
cd SimpliCMS/
composer install
```

**3. Configure the environment**:

> The `.env` file is in the app's [root directory](https://laravel.com/docs/9.x/configuration#environment-configuration).

- Create a database for your application.
- Initialize .env (quickly: `cp .env.example .env && php artisan key:generate`.
- add the DB credentials to the `.env` file.

**4. Install Database**:

Run this command:

```bash
php artisan core:module:migrate --seed
```

**6. Create the first admin user**:

Run this command:

```bash
php artisan core:make:superuser
```
Enter your email, username name, password, **accept _admin_ as role**.

**7. Open the application**:

Run the site with your webserver