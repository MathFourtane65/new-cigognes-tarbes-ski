<?php

class EmailSender
{
    public static function sendMail($to, $subject, $message, $headers)
    {
        // Assurez-vous que les en-têtes soient au format RFC 2822
        $headers = str_replace("\n", "\r\n", $headers);

        // Envoi de l'e-mail
        if (mail($to, $subject, $message, $headers)) {
            return true;
        } else {
            return false;
        }
    }
}
?>