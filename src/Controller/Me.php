<?php


namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @Route("/api")
 */
class Me extends AbstractController
{
    /**
     * @Route(name="my", path="/me", methods={"GET"})
     */
    public function my()
    {
        $user = $this->getUser();
        return new JsonResponse(
            [
                'id' => $user->getId(),
                'username' => $user->getUsername(),
                'roles' => $user->getRoles()
            ]
        );
    }

}
