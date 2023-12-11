# Đồ án Web 2
# Trang web bán quần áo (Mô hình MVC)

## Ngôn ngữ và Kỹ năng

Dưới đây là một số ngôn ngữ lập trình và kỹ năng mà chúng tôi đã dùng để phát triển dự án:

- **Front-end:**
  - HTML
  - CSS
  - JS
  - Bootstrap

- **Back-end:**
  - PHP

- **Cơ sở dữ liệu:**
  - MySQL

- **Công cụ và Kỹ năng khác:**
  - Git
  - Ckfinder/Ckeditor
  - PHPMailer

## Tính Năng Chính
  - Quản lý tài khoản (Đăng nhập, đăng kí, quên mật khẩu)
  - Các chức năng cho người quản trị (thống kê, phân quyền, quản lý sản phẩm, người dùng, hóa đơn,...)
  - Các chức năng cho người dùng cuối (tìm kiếm sản phẩm, mua sản phẩm, theo dõi đơn hàng, đánh giá sản phẩm)
  - Sử dụng kỹ thuật fetch api (phân trang, tìm kiếm sản phẩm, kiểm tra đăng nhập)

## Hướng Dẫn Cài Đặt
1. Clone repository: `git clone https://github.com/tienhai488/Web2.git` 
2. Khởi tạo database: do_an_web (import file database/do_an_web.sql)
3. Thay đổi cấu hình database: configs/database.php
4. Thay đổi cấu hình email trang web: configs/Functions.php (function sendMail)
  - $mail->Username   = 'example@gmail.com';      
  - $mail->Password   = 'password';  


