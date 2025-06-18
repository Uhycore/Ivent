<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Permintaan Pembayaran</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;">
    <div style="max-width: 600px; margin: auto; background: #fff; padding: 25px; border-radius: 6px; box-shadow: 0 2px 6px rgba(0,0,0,0.05);">
        <h2 style="color: #2c3e50;">Permintaan Pembayaran</h2>

        <?php
        echo "<pre>";
        print_r($user->toArray());
        echo "</pre>";
        echo "<pre>";
        print_r($pendaftaran->toArray());
        echo "</pre>";
        ?>

        <p>Terima kasih atas perhatian dan kerjasamanya.</p>

        <p>Salam,<br><strong>Panitia</strong></p>
    </div>
</body>
</html>
