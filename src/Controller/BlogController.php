<?php

namespace App\Controller;

use App\Entity\Project;
use App\Entity\Manager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
   /**
     * @param Request $request
     * @Route("/add_blog/{manager_id}", name="blog_add")
     */
    public function addProject(Request $request, $manager_id)
    {
        $ManagerRepository = $this->getDoctrine()->getRepository(Manager::class);
        $manager = $ManagerRepository->findOneBy(['id' => $manager_id]);
        if ($request->request->has('name') && $request->request->has('status')) {
            $project = new Project();
            $project->setName($request->request->get('name'));
            $project->setStatus($request->request->get('status'));
            $project->setStartedAt(new \DateTime());
            $project->setEndedAt(new \DateTime());

            $this->getDoctrine()->getManager()->persist($project);
            $this->getDoctrine()->getManager()->flush();
        }

        return $this->render('blog/add.html.twig', [
            'manager' => $manager
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @Route("/blog/{id}", name="show")
     */
    public function showProject(Request $request, $id)
    {
        $projectRepository = $this->getDoctrine()->getRepository(Project::class);
        $project = $projectRepository->findOneBy(['id' => $id]);

        $otherProjects = $projectRepository->getOtherProjects($id, $project->getManager());

        $managerRepository = $this->getDoctrine()->getRepository(Manager::class);

       /* if ($request->request->has('name') && $request->request->has('manager')) {
            $manager = $ManagerRepository->find($request->request->get('manager'));
            $comment = new Comment();
            $comment->setContent($request->request->get('content'));
            $comment->setCreatedAt(new \DateTime());
            $comment->setPost($post);
            $comment->setUser($user);

            $this->getDoctrine()->getManager()->persist($comment);
            $this->getDoctrine()->getManager()->flush(); */
        }

       /* $commentRepository = $this->getDoctrine()->getRepository(Comment::class);
        $comments = $commentRepository->findBy(['post' => $id], ['createdAt' => 'DESC']);

        $users = $userRepository->findAll();

        return $this->render('post/show.html.twig', [
            'post' => $post,
            'otherPosts' => $otherPosts,
            'comments' => $comments,
            'users' => $users
        ]); 
    } */
}