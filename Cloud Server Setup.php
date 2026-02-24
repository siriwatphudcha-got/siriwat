Cloud Server Setup (ทำครั้งแรกบนเซิร์ฟเวอร์)
1) เข้าเครื่องด้วย SSH
ssh root@<IP Address>
2) อัปเดตแพ็กเกจ + ติดตั้งของจำเป็น
sudo apt update
sudo apt install git
sudo apt-get install mariadb-server
3) ตั้งค่า MariaDB ให้ปลอดภัยขึ้น (สำคัญมาก)
sudo mysql_secure_installation

โดยทั่วไปจะถามพวก:

ตั้งรหัส root

ลบ anonymous user

ปิด remote root login (บางกรณี)

ลบ test database

reload privilege

4) ติดตั้ง phpMyAdmin + PHP
sudo apt-get install phpmyadmin
sudo apt -y install php php-common
5) เข้า phpMyAdmin บน Cloud

ไปที่:

http://<IP Address>/phpmyadmin/

phpMyAdmin คือเครื่องมือจัดการฐานข้อมูลผ่านเว็บ ช่วยสร้าง DB / ตาราง / import-export ได้ง่าย (แนวเดียวกับที่เรียนบทจัดการฐานข้อมูล) 

บทที่ 9 การติดตั้งโปรแกรมสำหรับ…

6) เอาโค้ดเว็บขึ้นไปไว้ที่ /var/www/html
cd /var/www/html/
sudo git clone https://github.com/<user>/<repo>.git
7) เปิดเว็บโปรเจกต์บน Cloud
http://<IP Address>/<โฟลเดอร์โปรเจกต์>/
B) ตั้งค่า Git ให้ถูก (ทำ “ทุกเครื่องใหม่”)

ถ้าเครื่องไหนยังไม่ set user จะ push แล้วเพี้ยนชื่อ/อีเมลได้

git config --global user.name "Your Name"
git config --global user.email "your-email@example.com"

แนะนำให้ใช้ email เดียวกับ GitHub เพื่อประวัติ commit สวยและไม่หลุดบัญชี

C) ทำงานในเครื่อง (XAMPP + VS Code) แบบที่อาจารย์ให้ทำ

จากโครงสร้างที่อาจารย์กำหนด (a,b,c,…,g) แล้วให้คุณทำงานต่อในโฟลเดอร์ใหม่ “h”:

1) เปิด VS Code → Open Folder

เปิดไปที่:

C:\xampp\htdocs\
2) Clone งานจาก GitHub ลงเครื่อง (ครั้งแรก)
git clone https://github.com/<ชื่อUser>/<ชื่อตนเองภาษาอังกฤษ>.git
3) สร้างโฟลเดอร์งาน “h”

ตัวอย่าง:

C:\xampp\htdocs\ekkachai\h\
4) ทำแลปในโฟลเดอร์ h ให้เสร็จ

ถ้าเป็น “ฟอร์มรับข้อมูล” ให้จำว่า <form method="post/get" action="..."> และ input ต่าง ๆ ต้องอยู่ใน <form>...</form> (POST/GET มักออกสอบและออกแลปบ่อยมาก) 

บทที่ 17 การสร้างฟอร์มรับข้อมูล

ถ้าเป็น “เงื่อนไข/วนลูป” ให้ใช้ if/else/elseif/switch + for/while ตามโจทย์ 

บทที่ 12 คำสั่งตรวจสอบเงื่อนไขแ…

ถ้าเป็น “ตัวแปร” ให้จำกฎ $name / ตัวพิมพ์เล็กใหญ่คนละตัว และการใช้ "..." กับ '...' ต่างกัน 

บทที่ 11 ตัวแปรและตัวดำเนินการข…

5) Push งานขึ้น GitHub (ทุกครั้งที่ทำเสร็จ)

เข้าโฟลเดอร์ repo ก่อน แล้วค่อย:

git add .
git commit -m "finish lab h"
git push
D) อัปเดตโค้ดบน Cloud ให้เป็นเวอร์ชันล่าสุด (ทำทุกครั้งหลัง push)

SSH เข้า Cloud

ssh root@<IP จริง>

ไปโฟลเดอร์โปรเจกต์บน Cloud (ตามที่อาจารย์บอก)

cd /var/www/html/ekkachai/

ดึงโค้ดล่าสุดจาก GitHub

git pull

ทดสอบบนเว็บ

เว็บ: http://<IP จริง>/<โฟลเดอร์โปรเจกต์>/

phpMyAdmin: http://<IP จริง>/phpmyadmin/