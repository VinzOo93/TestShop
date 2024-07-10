<?php
declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @Route("/panier/", name="cart_detail")
     */
    public function listing(RequestStack $requestStack): Response
    {
        $session = $requestStack->getSession();
        $cart = $session->get('cart', []);

        return $this->render('cart/detail.html.twig', [
            'cart' => $cart,
            'totalPrice' => array_sum(array_map(function ($item) {
                return $item['item']->getPrice() * $item['qty'];
            }, $cart)),
        ]);
    }

    /**
     * @Route("/panier/supprimer/{key}", name="cart_remove")
     */
    public function delete($key, RequestStack $requestStack): Response
    {
        $session = $requestStack->getSession();
        $cart = $session->get('cart', []);
        unset($cart[$key]);
        $session->set('cart', $cart);

        return $this->listing($requestStack);
    }

    /**
     * @Route("/panier/ajouter/{key}", name="cart_increase")
     */
    public function increase($key, RequestStack $requestStack): Response
    {
        $session = $requestStack->getSession();
        $cart = $session->get('cart', []);
        ++$cart[$key]['qty'];
        $session->set('cart', $cart);

        return $this->listing($requestStack);
    }

    /**
     * @Route("/panier/retirer/{key}", name="cart_decrease")
     */
    public function decrease($key, RequestStack $requestStack): Response
    {
        $session = $requestStack->getSession();
        $cart = $session->get('cart', []);
        $qty = $cart[$key]['qty']--;

        if($qty > 0) {
            $session->set('cart', $cart);
            return $this->listing($requestStack);
        } else {
            return $this->delete($key, $requestStack);
        }

    }
}
