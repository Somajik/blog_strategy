<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserController extends AbstractController
{
    #[Route('/user/{username}', name: 'app_profile')]
    public function index(?User $user, EntityManagerInterface $em, UserPasswordHasherInterface $userPasswordHasher, Request $request): Response
    {
        if (!$user){
            return $this->redirectToRoute('home');
        }
        $defaultData = ['username' => $user->getUsername()];
        $form = $this->createFormBuilder($defaultData)
            ->add('username', TextType::class,[
                'required'=>'false',
                'label'=>'Nom d\'utilisateur',
            ])
            ->add('password', PasswordType::class,[
                'required'=>'false',
                'label' => 'Mot de passe'
            ])
            ->add('Modifier_le_profil', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $data = $form->getData();

            if ($data['username']) {
                $user->setUsername($data['username']);
            }
            if ($data['password']) {
                $user->setPassword($userPasswordHasher->hashPassword($user, $data['password']));
            }
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('home');
        }
        return $this->render('user/index.html.twig',[
            'user'=> $user,
            'updateForm' => $form->createView(),
        ]);
    }




    #[Route('/register', name: 'register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $em): Response
    {
        $user = new User();

        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword($userPasswordHasher->hashPassword($user, $form->get('plainPassword')->getData()));

            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('user/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    #[Route('/login', name: 'login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->isGranted('IS_AUTHENTICATED_FULLY')) {
        //     return $this->redirectToRoute('home');
        // }

        return $this->render('user/login.html.twig', [
            'last_username' => $authenticationUtils->getLastUsername(),
            'error' => $authenticationUtils->getLastAuthenticationError()
        ]);
    }

    #[Route('/logout', name: 'logout')]
    public function logout()
    {
         throw new \Exception('Don\'t forget to activate logout in security.yaml');
    }

    #[Route('/app/user/delete/{id}', name: 'app_delete_user')]
    public function deleteUser($id,EntityManagerInterface $entityManagerInterface)
    {
        $repository = $entityManagerInterface->getRepository(User::class);
        $user = $repository->find($id);
        $entityManagerInterface->remove($user);
        $entityManagerInterface->flush();
        return $this->redirectToRoute('home');
    }
}
