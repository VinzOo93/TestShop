<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\Movie;
use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{
    /**
     * @Route("/films/", name="movie_list")
     */
    public function list(MovieRepository $movieRepository): Response
    {
        $movies = $movieRepository->findAll();

        return $this->render('movie/list.html.twig', [
            'movies' => $movies,
        ]);
    }
    /**
     * @Route("/film/{id}", name="movie_detail")
     */
    public function detail(Movie $movie): Response
    {
        return $this->render('movie/detail.html.twig', [
            'movie' => $movie,
        ]);
    }

    /**
     * @Route("/film/{id}/ajouter-au-panier", name="movie_add_to_cart")
     */
    public function addToCart(Movie $movie, RequestStack $requestStack): Response
    {
        $session = $requestStack->getSession();

        $cart = $session->get('cart', []);
        $cart[$movie->getAsin()] = [ 'item' => $movie , 'qty' => ($cart[$movie->getAsin()]['qty'] ?? 0) + 1 ];
        $session->set('cart', $cart);

        return $this->detail($movie);
    }
}
