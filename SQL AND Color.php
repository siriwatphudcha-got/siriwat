คำสั่ง SQL สำหรับสร้างฐานข้อมูลและตาราง
นำไปรันใน phpMyAdmin ได้เลย
CREATE DATABASE 66010914019_db CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE 66010914019_db;

CREATE TABLE tb_66010914019 (
    song_id INT AUTO_INCREMENT PRIMARY KEY,
    song_name VARCHAR(100) NOT NULL,
    artist VARCHAR(100) NOT NULL,
    label_name VARCHAR(100) NOT NULL,
    genre VARCHAR(50) NOT NULL,
    detail TEXT
);


คำสั่ง SQL เพิ่มข้อมูลตัวอย่าง 5 แถว

INSERT INTO tb_66010914019 (song_name, artist, label_name, genre, detail) VALUES
('ฤดูร้อน', 'Paradox', 'จีเอ็มเอ็ม แกรมมี่', 'ร็อก', 'เพลงฮิตที่มีจังหวะสนุกและเป็นที่รู้จัก'),
('คุกเข่า', 'Cocktail', 'จีนี่ เรคคอร์ด', 'ร็อก', 'เพลงดังที่มีเนื้อหาเข้มข้นและอารมณ์ชัดเจน'),
('ถ้าเราเจอกันอีก', 'Tilly Birds', 'Gene Lab', 'ป๊อป', 'เพลงฮิตแนวป๊อปที่ได้รับความนิยมสูง'),
('นะหน้าทอง', 'โจอี้ ภูวศิษฐ์', 'ไทดอลมิวสิค', 'ลูกทุ่ง', 'เพลงดังที่มีเอกลักษณ์เฉพาะตัว'),
('เสาหลักของบ้าน แรงงานของนาย', 'เบียร์ พร้อมพงษ์', 'แกรมมี่โกลด์', 'ลูกทุ่ง', 'เพลงสะท้อนชีวิตที่ได้รับความนิยมมาก')

รายการสี 

🔵 สีน้ำเงิน (Primary)
<button class="btn btn-primary">บันทึกข้อมูล</button>
<button class="btn btn-primary">ดูข้อมูลทั้งหมด</button>
<button class="btn btn-primary">เพิ่มข้อมูลเพลง</button>
⚪ สีเทา (Secondary)
<button class="btn btn-secondary">บันทึกข้อมูล</button>
<button class="btn btn-secondary">ดูข้อมูลทั้งหมด</button>
<button class="btn btn-secondary">เพิ่มข้อมูลเพลง</button>
🟢 สีเขียว (Success)
<button class="btn btn-success">บันทึกข้อมูล</button>
<button class="btn btn-success">ดูข้อมูลทั้งหมด</button>
<button class="btn btn-success">เพิ่มข้อมูลเพลง</button>
🔴 สีแดง (Danger)
<button class="btn btn-danger">บันทึกข้อมูล</button>
<button class="btn btn-danger">ดูข้อมูลทั้งหมด</button>
<button class="btn btn-danger">เพิ่มข้อมูลเพลง</button>
🟡 สีเหลือง (Warning)
<button class="btn btn-warning">บันทึกข้อมูล</button>
<button class="btn btn-warning">ดูข้อมูลทั้งหมด</button>
<button class="btn btn-warning">เพิ่มข้อมูลเพลง</button>
🔵 สีฟ้า (Info)
<button class="btn btn-info">บันทึกข้อมูล</button>
<button class="btn btn-info">ดูข้อมูลทั้งหมด</button>
<button class="btn btn-info">เพิ่มข้อมูลเพลง</button>
⚪ สีขาว (Light)
<button class="btn btn-light">บันทึกข้อมูล</button>
<button class="btn btn-light">ดูข้อมูลทั้งหมด</button>
<button class="btn btn-light">เพิ่มข้อมูลเพลง</button>
⚫ สีดำ (Dark)
<button class="btn btn-dark">บันทึกข้อมูล</button>
<button class="btn btn-dark">ดูข้อมูลทั้งหมด</button>
<button class="btn btn-dark">เพิ่มข้อมูลเพลง</button>
🎯 ตัวอย่างจัดจริง (แนะนำใช้งาน)

นิยมใช้แบบนี้:

<button class="btn btn-success">บันทึกข้อมูล</button>
<button class="btn btn-primary">ดูข้อมูลทั้งหมด</button>
<button class="btn btn-warning">เพิ่มข้อมูลเพลง</button>
บันทึกข้อมูล → เขียว
ดูข้อมูลทั้งหมด → น้ำเงิน
เพิ่มข้อมูลเพลง → เหลือง