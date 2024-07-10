<?php

namespace App\Controller;

use App\Repository\BookRepository;
use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{


    /**
     * @Route("/", name="homepage")
     */
    public function index(MovieRepository $movieRepository, BookRepository $bookRepository)
    {
        return $this->render('default/index.html.twig', [
            'lastBooks' => $bookRepository->getLastFour(),
            'lastMovies' => $movieRepository->getLastFour(),
        ]);
    }
}
