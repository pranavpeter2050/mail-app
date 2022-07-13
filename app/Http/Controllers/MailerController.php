<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;

class MailerController extends Controller
{
    // public function sendEmail(MailerInterface $mailer): Response
    public function sendEmail(): Response
    {
        // $transport = Transport::fromDsn('smtp://localhost');
        $transport = Transport::fromDsn(env('MAILER_DSN'));
        $mailer = new Mailer($transport);

        $html = view('mail.testmail')->render();

        $email = (new Email())
            ->from('test@portal.faunaprotect.nl')
            ->to('ppeter@thoughtlinetech.com')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Time for Symfony Mailer! DreamWork Studios')
            ->text('Sending emails is fun again!')
            // ->html('<p>See Twig integration for better HTML integration!</p>');
            ->html($html);


        $mailer->send($email);

        // echo resource_path('views') . " -- ";

        return new Response('Mail sent.');

    }
}
