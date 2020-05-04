<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/http_posts")
 */
class HttpPost extends AbstractController
{

    /**
     * @Route(name="api_delete_all", path="/delete_all", methods={"DELETE"})
     */
    public function deleteAll()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $httpPosts = $entityManager->getRepository('App:HttpPost')->findAll();
        $countDeletes = 0;

        foreach ($httpPosts as $httpPost) {
            $entityManager->remove($httpPost);
            $countDeletes++;
        }
        $entityManager->flush();

        return new JsonResponse(['deletedItems' => $countDeletes]);
    }
}
