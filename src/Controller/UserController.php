<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ResetPasswordType;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormError;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("admin/user")
 */
class UserController extends AbstractController
{

    /**
     * @Route("/settings/{id}", name="user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, User $user): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
            
        ]);
    }

    /**
     * @Route("/password/{id}", name="password_edit", methods={"GET","POST"})
     */
    public function resetpassword(Request $request, UserPasswordEncoderInterface $encoder)
    {
    	$em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
    	$form = $this->createForm(ResetPasswordType::class, $user);
    	$form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $oldPassword = $request->request->get('reset_password')['oldPassword'];

            // Si l'ancien mot de passe est bon
            if ($encoder->isPasswordValid($user, $oldPassword)) {
                $newEncodedPassword = $encoder->encodePassword($user, $user->getPlainPassword());
                $user->setPassword($newEncodedPassword);
                $em->persist($user);
                $em->flush();
                $this->addFlash('notice', 'Votre mot de passe à bien été changé !');
                return $this->redirectToRoute('user_edit');

            } else {
                $form->addError(new FormError('Ancien mot de passe incorrect'));
            }
        }
    	return $this->render('user/resetPassword.html.twig', array(

    		'form' => $form->createView(),

    	));

    }

}
