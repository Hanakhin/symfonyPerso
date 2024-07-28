<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ContactFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class EmailController extends AbstractController
{
#[Route('/contact', name: 'app_contact')]
public function formContact(Request $request, MailerInterface $mailer): Response
{
$form = $this->createForm(ContactFormType::class);
$form->handleRequest($request);

if ($form->isSubmitted() && $form->isValid()) {
$formData = $form->getData();

try {
$email = (new Email())
->from($formData['email'])
->to('snow44111@gmail.com')
->subject($formData['subject'])
->text($formData['message']);

$mailer->send($email);

$this->addFlash('success', 'Message envoyé avec succès');

return $this->redirectToRoute('app_home');
} catch (\Exception $e) {
$this->addFlash('error', 'Erreur lors de l\'envoi du message : ' . $e->getMessage());
}
}

return $this->render('contact/contact.html.twig', [
'contactform' => $form->createView(),
]);
}
}
