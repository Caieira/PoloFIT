<?php

require 'conexao.php';
require '../vendor/autoload.php';
require '../config.php';

use PHPMailer\PHPMailer\PHPMailer;    

use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    $stmt = $pdo->prepare('SELECT id FROM alunos WHERE email = ?');
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user) {
        $token = bin2hex(random_bytes(50));
        $token_hash = hash('sha256', $token);

        $expiry = date("Y-m-d H:i:s", time() +3600);

        $stmt = $pdo->prepare("UPDATE alunos SET reset_token_hash = ?, reset_token_expires_at = ? WHERE email = ?");
        
        $stmt->execute([$token_hash, $expiry, $email]);


        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Username = SMTP_USER;
            $mail->Password = SMTP_PASSWORD;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;
            $mail->CharSet = 'UTF-8';

            $mail->setFrom('nao-responda@polofit.com','Academia PoloFIT');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Redefinição de senha - Academia PoloFIT';

            $reset_link = "http://localhost/projeto/login/redefinir_senha.php?token=$token";
            $mail ->Body = "Olá,<br><br>Para redefinir sua senha, por favor, clique no link a seguir: <a href='$reset_link'>Redefinir Senha</a><br><br>Se você não solicitou isso, pode ignorar este e-mail.";
            $mail->AltBody = "Para redefinir sua senha, copie e cole esse link no seu navegador: $reset_link";
            
            $mail->send();

            header("Location: ../login/email_enviado.php");
            exit();

        } catch (Exception $e) {
    die("A mensagem não pôde ser enviada. Erro do Mailer: {$mail->ErrorInfo}");
}


    }

    echo "<h1>Verifique seu E-mail</h1>";
    echo "<p>Se um e-mail correspondente for encontrado em nosso sistema, um link para redefinição de senha foi enviado. Por favor, verifique sua caixa de entrada e também a pasta de spam.</p>";
    echo "<a href='../login/login.php'>Voltar para o Login</a>";

}

?>