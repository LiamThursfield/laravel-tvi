# SIGI


## About SIGI

## Core Stack
- [Laravel](https://laravel.com/)
- [Tailwind CSS](https://tailwindcss.com/)
- [Vue.js](https://vuejs.org/)
- [Inertia](https://inertiajs.com/)


---------

## Installation

### Requirements
- [PHP](https://www.php.net/) >= 8.1
- [Composer](https://getcomposer.org/)

### Steps

1. Clone the repository
2. Copy `.env.example` to `.env`
    ```bash
    cp .env.example .env
    ```
3. Install dependencies to install [Laravel Sail](https://laravel.com/docs/10.x/sail#installation)
    ```bash
    composer install --ignore-platform-reqs
    ```
4. Start sail
    ```bash
    ./vendor/bin/sail up
    ```
5. Install composer dependencies
    ```bash
    ./vendor/bin/sail composer install
    ```
6. Install yarn dependencies
    ```bash
    ./vendor/bin/sail yarn
    ```
7. Generate application key
    ```bash
    ./vendor/bin/sail artisan key:generate
    ```
8. Run database migrations for the landlord/central database
    ```bash
    ./vendor/bin/sail artisan migrate
    ```
9. Create a sample tenant
    ```bash
    ./vendor/bin/sail artisan tenants:create
    ```
    1. For the ID - choose any unique string e.g. `tenant`
    2. For the domain(s) - choose the subdomain you'd like to use to access the tenant's routes e.g. `tenant` would result in `tenant.localhost`
10. (Optional) Run database seeders for the tenant database
    ```bash
    ./vendor/bin/sail artisan tenants:seed
    ```


---------


## Acknowledgements

### Icons
- [Tabler icons](https://github.com/tabler/tabler-icons)
- [Tailwind icons](https://tailwindcss.com/docs)

### Design/UI/UX inspiration
- [Argon](https://demos.creative-tim.com/argon-dashboard-pro/pages/dashboards/dashboard.html)
- [Bootstrap Themes](https://themes.getbootstrap.com/)
- [css.lab](https://csslab.app/)
- [Front](https://htmlstream.com/front-dashboard/index.html)
- [Keen](https://preview.keenthemes.com/keen/demo1/index.html)
- [Oppi](https://droitthemes.com/wp/oppi/)
