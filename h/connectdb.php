<?php
declare(strict_types=1);

/*
 |------------------------------------------
 | Database Configuration (Local + Cloud)
 |------------------------------------------
 | ไฟล์นี้ทำหน้าที่เก็บ config เท่านั้น
 | ไม่มี HTML / ไม่มี echo
 | ทุกไฟล์อื่นจะ require ไฟล์นี้
 */

return [
    'host' => 'localhost',      // cloud + local ใช้ localhost
    'db'   => '4199db',         // ฐานข้อมูลกลาง (แชร์)
    'user' => 'root',           // user database
    'pass' => '',               // cloud อาจมีรหัส → แก้เฉพาะเครื่อง
    'charset' => 'utf8mb4',
];
