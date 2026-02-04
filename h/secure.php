<?php
declare(strict_types=1);
session_start();

if (!isset($_SESSION['aid'])) {
    header('Location: index.php');
    exit;
}
