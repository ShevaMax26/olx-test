<?php

namespace App\Mail;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Symfony\Component\Dotenv\Dotenv;

class MailHogMailer
{
    private string $to;
    private string $subject;
    private string $message;
    private string $from;
    private string $smtpServer;
    private int $smtpPort;

    public function __construct(string $to, string $subject, string $message, string $from)
    {
        $this->to = $to;
        $this->subject = $subject;
        $this->message = $message;
        $this->from = $from;
        $this->loadEnv();
    }

    private function loadEnv(): void
    {
        $dotenv = new Dotenv();
        $dotenv->load(dirname(__DIR__) . '/../.env');

        $this->smtpServer = $_ENV['MAIL_HOST'] ?? null;
        $this->smtpPort = $_ENV['MAIL_PORT'] ?? null;
    }

    public function send(): bool
    {
        $mail = new PHPMailer(true);

        try {
            // Налаштування сервера і параметрів
            $mail->isSMTP();
            $mail->Host = $this->smtpServer;
            $mail->Port = $this->smtpPort;

            // Налаштування відправника і отримувача
            $mail->setFrom($this->from);
            $mail->addAddress($this->to);

            // Встановлення теми та тіла листа
            $mail->CharSet = 'UTF-8';
            $mail->Subject = $this->subject;
            $mail->Body = $this->message;

            // Відправлення листа
            $mail->send();
            return true;
        } catch (Exception $e) {
            dump($e);
            return false;
        }
    }
}