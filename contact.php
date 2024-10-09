<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject = strip_tags(trim($_POST["subject"]));
    $message = trim($_POST["message"]);

    // Validasi data
    if (empty($name) || empty($email) || empty($subject) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Tolong lengkapi form dengan benar.";
        exit;
    }

    // Alamat email Anda di sini
    $recipient = "xxlouisxav@gmail.com";

    // Buat konten email
    $email_content = "Name: $name\n";
    $email_content = "Email: $email\n";
    $email_content = "Subject: $subject\n\n";
    $email_content .= "Message:\n$message\n";

    // Header email
    $email_headers = "From: $name <$email>";

    // Kirim email
    if (mail($recipient, $subject, $email_content, $email_headers)) {
        // Jika berhasil
        http_response_code(200);
        echo "Pesan Anda berhasil dikirim!";
    } else {
        // Jika gagal
        http_response_code(500);
        echo "Oops! Terjadi kesalahan saat mengirim pesan.";
    }
} else {
    // Jika bukan POST request
    http_response_code(403);
    echo "Hanya POST request yang diperbolehkan.";
}
?>
