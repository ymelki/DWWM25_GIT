<?php

namespace App\Controller;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="app_home")
     */
    public function index(MailerInterface $mail): Response
    {
        $lemail=new TemplatedEmail();
        $lemail->from('hello@example.com')
                ->to('you@example.com') 
                ->subject('Time for Symfony Mailer!')
               // path of the Twig template to render
                ->htmlTemplate('mail/home.html.twig')
                ->context([
                    'expiration_date' => new \DateTime('+7 days'),
                    'username' => 'Yoel',
                ]);

        $mail->send($lemail);
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
