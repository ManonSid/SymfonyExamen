<?php

namespace App\Controller;

use App\Entity\Project;
use App\Entity\Manager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ManagerController extends AbstractController
{
    /**
     * @Route("/manager", name="manager")
     */
    public function index()
    {
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'ManagerController',
        ]);
    }

    /**
     * @Route("/register", name="blog")
     */
    public function register(Request $request)
    {
        if ($request->request->has('username') && $request->request->has('password')) {
            $manager = new Manager();
            $manager->setUsername($request->request->get('username'));
            $manager->setPassword($request->request->get('password'));
            $manager->setCreatedAt(new \DateTime());
            
            $this->getDoctrine()->getManager()->persist($manager);
            $this->getDoctrine()->getManager()->flush();
        }
        return $this->render('blog.html.twig');
    }
    
}
