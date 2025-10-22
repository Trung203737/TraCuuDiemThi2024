// ...existing code...
# G-Scores — Tra cứu điểm thi THPT 2024

Ứng dụng Laravel nhỏ dùng để tra cứu và báo cáo điểm thi THPT 2024.

## Mô tả ngắn
- Người dùng có thể tra cứu điểm theo số báo danh (SBD).
- Hiển thị chi tiết điểm từng môn và tổng điểm theo các khối (A, B, C).
- Trang báo cáo thống kê số lượng học sinh theo mức điểm cho từng môn.
- Trang Top 10 học sinh khối A (Toán - Lý - Hóa).
- Dữ liệu được import từ file CSV thông qua seeder.
## Công nghệ sử dụng
** Backend
- Framework: Dự án được xây dựng trên Laravel, sử dụng các tính năng MVC (Model-View-Controller) để quản lý logic ứng dụng, cơ sở dữ liệu (qua Eloquent ORM), định tuyến (Routing), và xử lý xác thực (Authentication).
Ngôn ngữ: PHP.

** View Layer
Engine: Giao diện người dùng được xây dựng bằng Blade Templating Engine.
## Những thành phần chính
- Routes: [routes/web.php](routes/web.php) — các route chính của ứng dụng.
- Controllers:
  - [`App\Http\Controllers\StudentController`](app/Http/Controllers/StudentController.php) — tra cứu SBD.
  - [`App\Http\Controllers\ReportController`](app/Http/Controllers/ReportController.php) — thống kê theo môn.
  - [`App\Http\Controllers\TopController`](app/Http/Controllers/TopController.php) — Top 10 khối A.
- Model:
  - [`App\Models\Student`](app/Models/Student.php) — model học sinh.
- Migrations:
  - [database/migrations/2025_10_20_015128_create_students_table.php](database/migrations/2025_10_20_015128_create_students_table.php)
- Seeder:
  - [`Database\Seeders\StudentSeeder`](database/seeders/StudentSeeder.php) — import dữ liệu từ CSV.
- Views:
  - [resources/views/scores.blade.php](resources/views/scores.blade.php) — trang tra cứu và hiển thị kết quả.
  - [resources/views/report.blade.php](resources/views/report.blade.php) — trang báo cáo (Chart.js).
  - [resources/views/top_group_a.blade.php](resources/views/top_group_a.blade.php) — Top 10 khối A.
- Entry point web: [public/index.php](public/index.php)
- Docker: [Dockerfile](Dockerfile) (cấu hình image PHP + Apache)

## Cài đặt nhanh (local)
1. Sao chép repo, chuyển tới thư mục dự án.
2. Tạo file env:
   - cp .env.example .env
   - chỉnh các biến môi trường cần thiết (DB, APP_URL,...)
   Hãy sửa lại phần database config trong file .env như sau (giả sử bạn dùng XAMPP):
  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=diemthithpt
  DB_USERNAME=root
  DB_PASSWORD=
3. Cài PHP dependencies:
   - composer install
4. Cài Node (frontend):
   - npm install
   - npm run dev (hoặc npm run build)
5. Tạo DB và migrate + seed:
  Mở http://localhost/phpmyadmin -> Nhấn tab Databases -> Nhập tên
** Nhập các lệnh sau ở teminal thư mục gốc của dự án
  php artisan migrate
  php artisan migrate:fresh
  php artisan db:seed --class=StudentSeeder

6. Chạy server:
   - php artisan serve
   - hoặc khởi động Docker theo Dockerfile / docker-compose.yml

## Dữ liệu mẫu
- Dữ liệu điểm được import bởi [`Database\Seeders\StudentSeeder`](database/seeders/StudentSeeder.php). File CSV mặc định: `database/seeders/data/diem_thi_thpt_2024.csv`.


## Một vài route hữu ích
- GET /  — trang tra cứu ([routes/web.php](routes/web.php))
- POST /search — tìm theo SBD (xử lý bởi [`App\Http\Controllers\StudentController`](app/Http/Controllers/StudentController.php))
- GET /report — báo cáo thống kê ([`App\Http\Controllers\ReportController`](app/Http/Controllers/ReportController.php))
- GET /top-group-a — Top 10 khối A ([`App\Http\Controllers\TopController`](app/Http/Controllers/TopController.php))

## Tên miền đã triển khai sử dụng render + EWS 
https://tracuudiemthi2024.onrender.com

## Video Demo
https://drive.google.com/file/d/17EP8KvhS6JwbuLrkZrU7FyPptF06pmgH/view?usp=drive_link
