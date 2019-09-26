<?php

namespace App\Controller;

use App\Entity\PasswordUpdate;
use App\Entity\User;
use App\Form\AccountType;
use App\Form\PasswordUpdateType;
use App\Form\RegistrationType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AccountController extends AbstractController
{
    /**
     * Permet de se connecter
     * @Route("/login", name="account_login")
     * @param AuthenticationUtils $utils
     * @return Response
     */
    public function login(AuthenticationUtils $utils)
    {
        $error = $utils->getLastAuthenticationError();
        $username = $utils->getLastUsername();

        dump($error);

        return $this->render('account/login.html.twig', [
            'hasError' => $error !== null,
            'username'=>$username
        ]);
    }

    /**
     * Permet de se deconnecter
     * @Route("/logout", name="account_logout")
     */
    public function logout()
    {

    }

    /**
     * Permet d'afficher le formulaire d'inscription
     * @Route("/register", name="account_register" )
     * @param Request $request
     * @param ObjectManager $manager
     * @param UserPasswordEncoderInterface $encoder
     * @return Response
     */
    public function register(Request $request, ObjectManager $manager,
                             UserPasswordEncoderInterface $encoder)
    {
        $user= new User();

        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted()&& $form->isValid()){
            $hash = $encoder->encodePassword($user, $user->getHash());
            $user->setHash($hash);
            $manager->persist($user);
            $manager->flush();

            $this->addFlash('success',
                "Votre compte a bien été crée ! Vous pouvez vous connecter !"
            );

            return $this->redirectToRoute('account_login');
        }

       return $this->render('account/registration.html.twig',[
            'form'=>$form->createView()
        ]);
    }

    /**
     * Permet d'afficher etd e traiter le formulaire de modification de profil
     * @Route("/account/profile", name="account_profile")
     * @param UserInterface $user
     * @param Request $request
     * @param ObjectManager $manager
     * @return Response
     */
    public function profile(UserInterface $user, Request $request, ObjectManager $manager)
    {
        $form = $this->createForm(AccountType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($user);
            $manager->flush();

            $this->addFlash("success", "Les données du profil ont été enregistré avec succès !");
        }

        return $this->render('account/profile.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/account/password-update", name="account_password")
     * @param Request $request
     * @param UserPasswordEncoderInterface $encoder
     * @param ObjectManager $manager
     * @return Response
     */
    public function updatePassword(Request $request, UserPasswordEncoderInterface $encoder, ObjectManager $manager){
        $passwordUpdate = new PasswordUpdate();

        $user = $this->getUser();

        $form=$this->createForm(PasswordUpdateType::class, $passwordUpdate);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
            //1. Verifier que le old password du formulaire soit le meme que le password de l'user
            if(!password_verify($passwordUpdate->getOldPassword(), $user->getHash())){
                //Gerer l'erreur
                $form->get('oldPassword')->addError(new FormError("Le mot de passe que vous avez saisi n'est pas votre mot de passe actuel ! "));
            } else{
                $newPassword = $passwordUpdate->getNewPassword();
                $hash = $encoder->encodePassword($user, $newPassword);
                $user->setHash($hash);

                $manager->persist($user);
                $manager->flush();

                $this->addFlash("success", "Votre mot de passe a bien été modifié");

                return $this->redirectToRoute('homepage');

            }
            //password_verify('password','$2y$13$awwBaJdv3tea/JLjKdREnuIx0mbvR0QQtaBuYS/fPQr...' );


        }

        return $this->render("account/password.html.twig", [
            'form'=> $form->createView()
        ]);
    }

    /**
     * Permet d'afficher le profil de l'utilisateur connecté
     * @Route("/account", name="account_index")
     * @return Response
     */
    public function myAccount()
    {
        return $this->render('user/index.html.twig',[
            'user' =>$this->getUser()
        ]);
    }

}
