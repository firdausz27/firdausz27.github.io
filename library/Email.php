<?php

function kirimEmail(Personal $personal){
    $fullName=$personal->getNamaAwal().' '.$personal->getNamaTengah().' '.$personal->getNamaAkhir();
    $username=$personal->getUser()->getUsername();
    $password=encrypt_decrypt('decrypt',$personal->getUser()->getPassword());
    $to = $personal->getEmail();
    $subject = "Mengingatkan Akun";

    $message = "
    <html>
    <head>
    <title>Mengingatkan Akun Anda</title>
    </head>
    <body>
    <p>Terima kasih telah mendaftarkan diri di Sistem Manajemen Ma'had Daarul Muwahhid </p>
    <table>
    <tr>
        <td>Nama</td>
        <td>: $fullName</td>
    </tr>
    <tr>
        <td>Username</td>
        <td>: $username</td>
    </tr>
    <tr>
        <td>Password</td>
        <td>: $password</td>
    </tr>
    <tr>
        <td>Email</td>
        <td>: $to</td>
    </tr>
    </table>
    <p>Silahkan lalukan perubahan password anda, untuk menjaga kerahasiaan http://daarulmuwahhid.org/sim</p>
    </body>
    </html>
    ";
    // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    
    $headers .= 'From: <info@daarulmuwahhid.org>' . "\r\n";
    //$headers .= 'Cc: myboss@example.com' . "\r\n";
    $mail = mail($to,$subject,$message,$headers);
    if($mail){
        return true;
    }else{
        return false;
    }
}