<?php

namespace App\Service;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;

class Mail{

    private $monmail;

    public function __construct(MailerInterface $mail)
    {
        $this->monmail=$mail;
    }


    public function send($data){
        
        $lemail=new TemplatedEmail();
        $lemail->from('admin@example.com')
                ->to('admin@example.com') 
                ->subject('Time for Symfony Mailer!')
               // path of the Twig template to render
                ->htmlTemplate('mail/contact.html.twig')
                ->context([
                    'expiration_date' => new \DateTime('+7 days'),
                    'username' => 'Yoel',
                    'data' => $data
                ]);

        $this->monmail->send($lemail);


    }
}