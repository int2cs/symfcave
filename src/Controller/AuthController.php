<?php

namespace App\Controller;

use Psr\EventDispatcher\EventDispatcherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\AuthenticationEvents;
use Symfony\Component\Security\Core\Event\AuthenticationEvent;

class AuthController extends AbstractController
{
    /**
     * @Route("/login", name="auth_login")
     */
    public function login()
    {
        return $this->redirectToRoute('wines_list');
    }

    /**
     * @Route("/logout", name="auth_logout")
     */
    public function logout()
    {
    }
}
