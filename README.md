# Campus Connect

Android app I built back in 2019 for my engineering college. Connects students, teachers and non-teaching staff for the usual college stuff - notices, syllabus tracking, attendance, branch-wise file sharing.

<p align="center">
  <img src="docs/screenshots/01-role-selection.png" width="220" alt="Role selection screen" />
  <img src="docs/screenshots/02-login.png" width="220" alt="Login screen" />
  <img src="docs/screenshots/03-teacher-branches.png" width="220" alt="Teacher branch selection" />
</p>

## What it does

Student
- register/login with username + GR number + password
- pick branch and year on first login
- view notices and branch-wise files
- check off syllabus chapters
- check your attendance %

Teacher
- login with username + teacher id + password
- post notices, upload files per branch
- mark attendance by roll number
- view attendance records
- update syllabus progress

Non-teaching staff
- login/register with username + staff id + password
- view/upload general files and notices

Branches: CMPN, IT, EXTC, ETRX, MECH, CIVIL

## Tech stack

- Android (Java), min SDK 21, target/compile SDK 27
- Gradle 5.6.4, AGP 3.6.4
- android-networking for API calls
- Glide for images
- Material Dialogs
- materialfilepicker + sublimepickerlibrary
- Backend: PHP (mysqli) + MySQL/MariaDB on Apache

## Backend setup

1. Install XAMPP (or WAMP/MAMP), start Apache + MySQL
2. Copy `backend/campusconnect` into your htdocs, keep the folder name as is
3. Import the schema:
   ```bash
   mysql -u root -p < backend/campusconnect/schema.sql
   ```
   This sets up the db and tables and throws in some demo data.
4. Check `config.php` has the right DB creds (defaults are just XAMPP's usual root / no password)
5. Make sure `uploads/` is writable
6. Open `http://localhost/campusconnect/config.php` in a browser - if you get empty JSON instead of a PHP error, you're good

## Android app setup

1. Open the project in Android Studio and let Gradle sync
2. Set the backend URL in `Constants.java` (under misc/utils) - leave it as `10.0.2.2` if you're using an emulator, or use your machine's LAN IP if running on a real device
3. Run it on an emulator (API 21-27) or a physical device

## Demo accounts

Password for all of these is `campus1234`

- Student - rohan.mehta, GR CMPN1901042
- Student - ayesha.khan, GR IT1901017
- Teacher - anjali.deshmukh, Teacher ID FAC0231
- Staff - suresh.pawar, Staff ID NT0119

Or just register a new account from the app.

## Developer

Anil Bhati, 2019
