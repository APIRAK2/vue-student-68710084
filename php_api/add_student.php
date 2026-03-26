<?php

include 'condb.php';

// รับค่า JSON จาก client

$data = json_decode(file_get_contents("php://input"), true);

$first_name = $data['first_name'] ?? '';
$last_name = $data['last_name'] ?? '';
$phone = $data['phone'] ?? '';
$email = $data['email'] ?? '';
$faculty = $data['faculty'] ?? '';


 // เช็คว่าข้อมูลเป็น JSON หรือไม่
if (!$data) {
    echo json_encode([
        "status" => "error",
        "message" => "รูปแบบ JSON ไม่ถูกต้อง"
    ]);
    exit;
}

  // เข้ารหัสรหัสผ่าน
   // $password_hash = password_hash($data["password"], PASSWORD_BCRYPT);

    try {
         // เพิ่มข้อมูลลูกค้า
        $sql = "INSERT INTO students (first_name, last_name, phone, email, faculty)
                VALUES (:first_name, :last_name, :phone, :email, :faculty)";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(":first_name", $data['first_name']);
        $stmt->bindParam(":last_name", $data['last_name']);
        $stmt->bindParam(":phone", $data['phone']);
        $stmt->bindParam(":email", $data['email']);
        $stmt->bindParam(":faculty", $data['faculty']);

        if ($stmt->execute()) {
            echo json_encode([
                "status" => "success",
                "message" => "เพิ่มข้อมูลเรียบร้อย"
            ]);
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "ไม่สามารถเพิ่มข้อมูลได้"
            ]);
        }

    } catch (PDOException $e) {
        echo json_encode([
            "status" => "error",
            "message" => $e->getMessage()
        ]);
    }

?>