<?php

namespace App\Controller;

use App\Lib\Info;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/api/media")
 */
class MediaObjectController extends AbstractController
{
    /**
     * @Route(name="download", path="/download/{id}", methods={"GET"})
     * @param int $id
     * @return BinaryFileResponse
     */
    public function download(int $id)
    {
        $image = $this->getDoctrine()->getManager()->getRepository('App:MediaObject')->findOneBy(['id' => $id]);
        $file = new File(Info::getMediaRoot() . '/' . $image->filePath);
        return $this->file($file);
    }
}
