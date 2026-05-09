<?php
if (isset($_POST['subject']) && isset($_POST['body'])) {

    try {
        $dbh = new PDO(
            'mysql:host=localhost;dbname=adatb4',
            'adatb4',
            'Cigi123',
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
        );
        $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');

        $subject = trim($_POST['subject']);
        $body    = trim($_POST['body']);

        if ($subject === '' || $body === '') {
            $uzenet = "Minden mező kitöltése kötelező!";
            return;
        }

        // 🔑 ITT DŐL EL: vendég vagy bejelentkezett
        if (isset($_SESSION['login_id'])) {
            $sender_name = $_SESSION['csn'] . ' ' . $_SESSION['un'];
            $user_id     = $_SESSION['login_id'];
        } else {
            $sender_name = 'Vendég';
            $user_id     = null;
        }

        $sql = "
            INSERT INTO messages (sender_name, subject, body, user_id)
            VALUES (:sender_name, :subject, :body, :user_id)
        ";

        $sth = $dbh->prepare($sql);
        $sth->execute([
            ':sender_name' => $sender_name,
            ':subject'     => $subject,
            ':body'        => $body,
            ':user_id'     => $user_id
        ]);

        $uzenet = "Üzenet sikeresen elküldve!";

    } catch (PDOException $e) {
        $uzenet = "Adatbázis hiba!";
    }
}