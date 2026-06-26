# 🎓 Satya Naratama – Online Tutoring Platform (Laravel 11)

Satya Naratama is a web-based **online tutoring (bimbel) platform** built with **Laravel 11**, designed to manage courses, meetings, exams (tryout & quiz), purchases, entitlements, notifications, and interactive learning features.

This project supports **Admin**, **Tentor (Teacher)**, and **Siswa (Student)** roles with a clear access control system.

---

## 🚀 Main Features

### 👤 User Roles
- **Admin**
  - Manage users, courses, meetings, exams
  - Manage orders & verify purchases
  - View all student entitlements
  - Full system access (no restrictions)

- **Tentor (Teacher)**
  - Manage meetings
  - Create and manage exams (post-test, tryout, quiz)
  - View student attempts and results

- **Siswa (Student)**
  - Buy courses, meetings, tryouts, quizzes
  - Access content based on entitlements
  - Attend meetings
  - Take exams and view results

---

### 📚 Course & Meeting System
- Courses contain multiple meetings
- Students can:
  - Buy **full course package**
  - Buy **individual meetings**
- Meeting access logic:
  - Full course → access all meetings
  - Individual meeting → access only purchased meetings
  - No access → meeting is locked (🔒 icon + toast message)

---

### 🧾 Purchase & Entitlement System
- Automatic entitlement granting after order verification
- Supported entitlement types:
  - `course`
  - `meeting`
  - `tryout` (global)
  - `quiz` (global)
- Bonus entitlements supported
- Centralized in `user_entitlements` table

---

### 📝 Exam System
- Exam types:
  - **Tryout** (global access)
  - **Daily Quiz** (global access)
  - **Post Test** (attached to meeting)
- Features:
  - Time-based access
  - Auto submit on timeout
  - Attempt tracking
  - Scoring & result pages
- Access control:
  - Students without entitlement cannot start exams
  - Call-to-action: *“Purchase Access”*

---

### 🔔 Notification System
- Database notifications
- Optional email delivery (Brevo SMTP)
- Real-time updates with **Pusher / WebSocket**
- Features:
  - Notification bell with unread badge
  - Latest 5 notifications dropdown
  - Full notification page
  - Mark as read
  - Mark all as read
  - Delete single or all notifications

---

### 📧 Email Notifications
- Custom Blade email templates
- Used for:
  - Purchase confirmation
  - Bonus granted
  - Exam activation
  - Important system updates
- SMTP provider: **Brevo**

---

### 🎮 Mini Games (Optional Fun Features)
- **Snake Game** (classic)
  - Keyboard (desktop)
  - Swipe controls (mobile)
- **Math Quiz Game**
- Frontend-only (no controller needed)
- Built with HTML + CSS + JavaScript
- Integrated into Laravel views

---

## 🛠 Tech Stack

- **Laravel 11**
- PHP 8.2+
- MySQL / MariaDB
- Tailwind CSS
- Alpine.js
- Pusher (Realtime)
- Brevo SMTP (Email)
- Spatie Laravel Permission

---

## ⚙️ Installation Guide (Laravel 11)

### 1️⃣ Clone Repository
```bash
git clone https://github.com/your-username/azwara-learning.git
cd azwara-learning
```

### 2️⃣ Install Dependencies
```bash
composer install
npm install
npm run build
```

### 3️⃣ Environment Setup
```bash
cp .env.example .env
php artisan key:generate
```

### 4️⃣ Configure Database

Edit .env:

```bash
DB_DATABASE=azwara_learning
DB_USERNAME=root
DB_PASSWORD=
```

### 5️⃣ Configure Mail (Brevo SMTP)
```bash
MAIL_MAILER=smtp
MAIL_HOST=smtp-relay.brevo.com
MAIL_PORT=587
MAIL_USERNAME=your-smtp-username@smtp-brevo.com
MAIL_PASSWORD=your-smtp-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="xxxxxxxx@gmail.com"
MAIL_FROM_NAME=
```

### 6️⃣ Configure Pusher (Realtime Notifications)
```bash
BROADCAST_CONNECTION=pusher

PUSHER_APP_ID=your_app_id
PUSHER_APP_KEY=your_key
PUSHER_APP_SECRET=your_secret
PUSHER_APP_CLUSTER=ap1
```

### 7️⃣ Run Migration & Seeder
```bash
php artisan migrate --seed
```

### 8️⃣ Storage & Cache
```bash
php artisan storage:link
php artisan optimize
```

### 9️⃣ Run Development Server
```bash
php artisan serve
```

## 🔐 Demo Accounts

All demo accounts use the same password:password
Admin
- Email: admin@bimbel.com

Students
- Email: siswa1@bimbel.com
- Email: siswa2@bimbel.com
- Email: siswa3@bimbel.com

## 📌 Notes
- Admin role is not restricted by access policies
- All access control applies only to Siswa
- Notifications do not conflict with: Email verification and Password reset notifications

## 📄 License
This project is open for educational and portfolio purposes.

## ✨ Author
Muhammad Afnan Alfian, S.Tr.Stat.
Alumni Politeknik Statistika STIS

Built with ❤️ for online education using Laravel 11.
