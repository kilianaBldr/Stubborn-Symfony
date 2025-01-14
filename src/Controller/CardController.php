<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Stripe\Stripe;
use Stripe\Checkout\Session;


class CardController extends AbstractController
{
    #[Route('/card', name: 'app_card')]
    public function index(): Response
    {
        $cartItems = $this->getCart(); //Simulation du panier
        $total = array_reduce($cartItems, fn($total, $item) => $total + ($item['price'] * $item['quantity']), 0 );

        return $this->render('card/index.html.twig', [
            'cartItems' => $cartItems,
            'total' => $total,
        ]);
    }

    #[Route('/cart/checkout', name: 'cart_checkout', methods: ['POST'])]
    public function checkout(): Response
    {
        Stripe::setApiKey($_ENV['STRIPE_SECRET_KEY']);

        $cartItems = $this->getCart(); // Simulation du panier

        $lineItems = array_map(fn($item) => [
            'price_data' => [
                'currency' => 'eur',
                'product_data' => [
                    'name' => $item['name'],
                ],
                'unit_amount' => $item['price'] * 100,
            ],
            'quantity' => $item['quantity'],
        ], $cartItems);

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [$lineItems],
            'mode' => 'payment',
            'success_url' => $this->generateUrl('home', [], true),
            'cancel_url' => $this->generateUrl('cart', [], true),
        ]);

        return $this->redirect($session->url, 303);
    }

    private function getCart(): array
    {
        return [
            ['id' => 1, 'name' => 'Sweatshirt 1', 'price' => 2999, 'quantity' => 1, 'size' => 'M'],
            ['id' => 2, 'name' => 'Sweatshirt 2', 'price' => 1999, 'quantity' => 2, 'size' => 'L'],
        ];
    }
}
