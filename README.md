-- Hướng dẫn sử dụng --
================
1. Tải file về để trong thư mục của XAMP/htdocs - sau đó thì giải nén ra sẽ được thư mục tên Website_BanVeXemPhim + README.md + file word
Đương dẫn của nó sẽ là như sau: XAMP/htdocs/Website_BanVeXemPhim.
**Lưu ý: phải để file đúng đường dẫn trên để có thể chạy đúng các đường dẫn có trong file
================
2. Nhập cơ sở dữ liệu
B1. Mở XAMPP vào admin của MySQL
B2. Import file csdl có tên là project_film.sql (Nếu đã có database tên này thì hãy DROP đi)
B3. Kết thúc
================
3. Để sử dụng trang admin thì hãy vào theo đường dẫn sau: 
http://localhost/Website_BanVeXemPhim/admin
 - Tài khoản của admin
+ Tên đăng nhập: admin
+ Mật khẩu: admin123
 - Tài khoản của nhân viên
+ Tên đang nhập: nhanvien
+ Mật khẩu: nhanvien1!
----------------------
- Với tài khoản của admin thì có thể sử dụng được hết tất cả các chức năng.
- Với tài khoản của nhanvien thì có một số chức năng sẽ bị khóa.
----------------------
**CHÚ Ý: Nếu muốn sử dụng được import file từ excel thì mở XAMPfile php.ini thực hiện các bước sau:
B1: Vào app XAMP Control Panel
B2: Ở Apache chọn "config"
B3: Chọn PHP(php.init)
B4: Bấm crl+f để tìm "extension=zip", sau đó bỏ dấu ";" trước câu.
B5: Lưu lại và chạy lại XAMP