<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthController extends AbstractController
{
    /**
     * @Route("/login", name="auth_login")
     */
    public function login()
    {
        return $this->render('home.twig');
    }

    /**
     * @Route("/logout", name="auth_logout")
     */
    public function logout()
    {
    }
}
