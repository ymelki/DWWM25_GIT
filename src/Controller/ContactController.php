<?php

namespace App\Controller;

use App\Form\ContactFormType;
use App\Service\Mail;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="app_contact")
     */
    public function index(Request $request, Mail $mail): Response
    {
            // on créé un formulaire de type contact Form/ContactType
            $formulaire=$this->createForm(ContactFormType::class);
            //Lit les données envoyé via l'url
            $formulaire->handleRequest($request);

            // on vérifie si les donnée sont envoyé
            if ($formulaire->isSubmitted()){

                // on recuperer les donnée envoyé
                $data=$formulaire->getData();

                // Utilisation du service de mail
                $mail->send($data,$from=$data['email']); 

                // on redirige vers la page envoye.html.twig
                // avec la variable data['nom']
                return $this->renderForm('contact/envoye.html.twig', [
                    'data' => $data
                ]);
            }
            // si non on renvoie vers la page de contact avec le form
            else {
                return $this->renderForm('contact/index.html.twig', [
                    'form' => $formulaire
                ]);
            }  

            
    }
}
