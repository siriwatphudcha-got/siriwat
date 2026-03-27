<?php
include("connect.php");

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $song_name = trim($_POST['song_name']);
    $artist = trim($_POST['artist']);
    $label_name = trim($_POST['label_name']);
    $genre = isset($_POST['genre']) ? $_POST['genre'] : "";
    $detail = trim($_POST['detail']);

    if ($song_name == "" || $artist == "" || $label_name == "" || $genre == "") {
        $message = "<div class='alert alert-danger'>กรุณากรอกข้อมูลให้ครบถ้วน</div>";
    } else {
        $sql = "INSERT INTO tb_66010914019 (song_name, artist, label_name, genre, detail)
                VALUES ('$song_name', '$artist', '$label_name', '$genre', '$detail')";

        if (mysqli_query($conn, $sql)) {
            $message = "<div class='alert alert-success'>บันทึกข้อมูลเรียบร้อยแล้ว</div>";
        } else {
            $message = "<div class='alert alert-danger'>เกิดข้อผิดพลาด: " . mysqli_error($conn) . "</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>ฟอร์มเพิ่มข้อมูลเพลงฮิต</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-dark text-white">
                    <h3 class="mb-0">ฟอร์มเพิ่มข้อมูลเพลงฮิต</h3>
                </div>
                <div class="card-body">
                    <?php echo $message; ?>

                    <form method="post" action="">
                        <div class="mb-3">
                            <label class="form-label">ชื่อเพลง</label>
                            <input type="text" name="song_name" class="form-control" placeholder="กรอกชื่อเพลง">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">ศิลปิน</label>
                            <input type="text" name="artist" class="form-control" placeholder="กรอกชื่อศิลปิน">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">สังกัด</label>
                            <input type="text" name="label_name" class="form-control" placeholder="กรอกชื่อสังกัด">
                        </div>

                        <div class="mb-3">
                            <label class="form-label d-block">แนวเพลง</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="genre" value="ป๊อป" id="pop">
                                <label class="form-check-label" for="pop">ป๊อป</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="genre" value="ร็อก" id="rock">
                                <label class="form-check-label" for="rock">ร็อก</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="genre" value="ลูกทุ่ง" id="country">
                                <label class="form-check-label" for="country">ลูกทุ่ง</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">รายละเอียดเพลง</label>
                            <textarea name="detail" class="form-control" rows="4" placeholder="กรอกรายละเอียดเพิ่มเติม"></textarea>
                        </div>

                        <button type="submit" class="btn btn-info text-white">บันทึกข้อมูล</button>
                        <a href="select_66010914019.php" class="btn btn-secondary">ดูข้อมูลทั้งหมด</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>