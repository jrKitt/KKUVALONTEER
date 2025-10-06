# KKUVALONTEER

ระบบจัดการกิจกรรมจิตอาสาสำหรับนักศึกษา | Khon Kaen University Student Volunteer Activity Management System

## Project Overview

**KKUVALONTEER** เป็นเว็บแอปพลิเคชันที่พัฒนาขึ้นเพื่อจัดการและส่งเสริมกิจกรรมจิตอาสาภายในมหาวิทยาลัย โดยมุ่งเน้นการพัฒนาศักยภาพนักศึกษานอกห้องเรียนและเชื่อมโยงกับเงื่อนไขการรับทุนการศึกษา

**KKUVALONTEER** is a web application designed to manage and promote volunteer activities within the university, focusing on student development outside the classroom and linking to scholarship requirements.

## Objectives

- ส่งเสริมให้กิจกรรมจิตอาสาเป็นส่วนหนึ่งของการพัฒนาศักยภาพนักศึกษาในด้านนอกห้องเรียน
- ใช้เป็นเงื่อนไขในการขอรับหรือรักษาทุนการศึกษา เช่น ทุนช่วยเหลือนักศึกษาที่ขาดแคลน หรือทุน กยศ.
- ให้นักศึกษาและผู้ดูแลระบบสามารถบริหารจัดการ ลงทะเบียน ติดตาม และรายงานกิจกรรมจิตอาสาได้อย่างมีประสิทธิภาพ

**English:**
- Promote volunteer activities as part of students' out-of-classroom development
- Serve as a criterion for applying for or maintaining student scholarships
- Enable students and administrators to efficiently manage, register, track, and report volunteer activities

## Technology Stack

**Backend:**
- Laravel (PHP Framework)
- MySQL / MariaDB

**Frontend:**
- Blade Template Engine
- JavaScript
- CSS

**Package Management:**
- Composer (PHP dependencies)
- NPM (Frontend dependencies)

## Installation and Setup

### System Requirements

- PHP >= 8.0
- Composer
- Node.js และ NPM
- MySQL / MariaDB

### Installation Steps

1. Clone repository

```bash
git clone https://github.com/yourusername/kkuvalonteer.git
cd kkuvalonteer
```

2. ติดตั้ง dependencies

```bash
composer install
npm install
```

3. สร้างไฟล์ environment configuration

```bash
cp .env.example .env
```

4. สร้าง application key

```bash
php artisan key:generate
```

5. ตั้งค่าฐานข้อมูลในไฟล์ .env

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=kkuvalonteer
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

6. สร้างฐานข้อมูลและ migrate

```bash
php artisan migrate
```

7. Build frontend assets

```bash
npm run dev
```

8. เริ่มต้น development server

```bash
php artisan serve --port=8000
```

เข้าถึงแอปพลิเคชันได้ที่: http://localhost:8000

## Project Structure

```
kkuvalonteer/
├── app/                    # Application core files
│   ├── Http/
│   │   ├── Controllers/   # Controllers
│   │   └── Middleware/    # Middleware
│   └── Models/            # Eloquent models
├── config/                # Configuration files
├── database/
│   ├── migrations/        # Database migrations
│   └── seeders/          # Database seeders
├── public/               # Public assets
├── resources/
│   ├── views/           # Blade templates
│   ├── js/              # JavaScript files
│   └── css/             # CSS files
├── routes/              # Route definitions
│   ├── web.php
│   └── api.php
└── storage/             # Storage files
```

## Contributors

- [@jrKitt](https://www.github.com/jrkitt) 
- [@AekkarinDEV](https://www.github.com/AekkarinDEV) 
- [@BB](https://www.github.com/B-bsw) 
- [@KokoKamijo](https://www.github.com/KokoKamijo) 

<img src="https://img5.pic.in.th/file/secure-sv1/Screenshot-2568-10-07-at-03.35.54.png" alt="Screenshot 2568 10 07 at 03.35.54" border="0">
