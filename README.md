<div align="center">

# 🦷 Dental Clinic Management System

<img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" />
<img src="https://img.shields.io/badge/Blade-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" />
<img src="https://img.shields.io/badge/Bootstrap-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white" />
<img src="https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white" />

A web application for managing a dental clinic with **3 doctors**, built with Laravel and Blade templates.

</div>

---

## Features

**Patients**
- Register and log in
- View available doctors and their schedules
- Book an appointment

**Admin**
- Secure admin dashboard
- Manage doctors and their schedules
- View, edit, and delete appointments

---

## Tech Stack

| Layer | Technology |
|-------|-----------|
| Framework | Laravel 12 |
| Templating | Blade |
| Styling | Bootstrap 5 |
| Database | MySQL |
| Auth | Laravel Breeze / Auth |

---

## Getting Started

```bash
# Clone & install
git clone https://github.com/mahmoudtawfik1998/dental-clinic.git
cd dental-clinic
composer install

# Setup environment
cp .env.example .env
php artisan key:generate
# → set DB credentials in .env

# Run migrations
php artisan migrate --seed

# Start the server
php artisan serve
```

---

## Demo Credentials

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@clinic.com | password |
| Patient | patient@test.com | password |

---

## License

[MIT](LICENSE)
