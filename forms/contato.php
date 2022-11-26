<?php
require 'conecta.php';

if(isset($_GET['salvar']) and $_GET['salvar'] == 'enviado'){

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $mensagem = $_POST['mensagem'];

    $stmt = db_conecta()->prepare("INSERT INTO usuarios (nome, email, telefone, mensagem) VALUES (:nome, :email, :telefone, :mensagem)");

    $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':telefone', $telefone, PDO::PARAM_STR);
    $stmt->bindParam(':mensagem', $mensagem, PDO::PARAM_STR);

    $stmt->execute();
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if(isset($_GET['salvar']) and $_GET['salvar'] == 'enviado'){

    $mail = new PHPMailer(true);

try {
     //credenciais SMTP
                     
    $mail->isSMTP();                                            
    $mail->Host       = 'smtp.gmail.com';                     
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = 'ageunubank@gmail.com';                     
    $mail->Password   = 'igskfmzjhpcyzsvo';                               
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
    $mail->Port       = 465;  //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS                     

    //Recebedor
    $mail->setFrom('ageunubank@gmail.com', '');
    $mail->addAddress('ageunubank@gmail.com', ''); 
    $mail->addReplyTo('ageunubank@gmail.com', '');
  
    $mail->isHTML(true);      
    $mail->Subject = 'Novo Contato - ImporteFile';

    $body = "Novo interessado:<br>
    Nome: ".$_POST['nome']."<br>
    Email: ".$_POST['email']."<br>
    Telefone: ".$_POST['telefone']."<br>
    Mensagem:<br>".$_POST['mensagem'];

    $mail->Body    = $body;
    $mail->AltBody = '';

    $mail->send();
 
    } catch (Exception $e) {
        echo "<script>alert('Erro ao enviar o email!');</script>: {$mail->ErrorInfo}";
    }
}


?>