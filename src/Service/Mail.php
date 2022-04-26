<?php

namespace App\Service;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;

class Mail{

    // un attribut permettant de recuperer le mailerinterface
    private $monmail;

    public function __construct(MailerInterface $mail)
    {
        // on de recuperer le mailerinterface dans l attribut mon mail
        $this->monmail=$mail;
    }


    public function send($data, $from){
        
        $lemail=new TemplatedEmail();
        $lemail->from($from)
                ->to('admin@gmail.com') 
                ->subject('Time for Symfony Mailer!')
               // path of the Twig template to render
                ->htmlTemplate('mail/contact.html.twig')
                ->context([
                    'expiration_date' => new \DateTime('+7 days'),
                    'username' => 'Yoel',
                    'data' => $data // envoie des données du tableau de form depuis le parametre de la méthode send
                ]);

        $this->monmail->send($lemail); 
    }
}