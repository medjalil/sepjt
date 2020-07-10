<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\EasyAdminController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends EasyAdminController {

    /**
     * @Route("/contact", name="contact")
     */
    public function createNewContactEntity(Request $request) {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contact);
            $entityManager->flush();
            $this->addFlash('success', 'Votre message a été envoyé avec succès');
            return $this->redirectToRoute('contact');
        }
        return $this->render('contact/index.html.twig', [
                    'contact' => $contact,
                    'form' => $form->createView(),
        ]);
    }

}
