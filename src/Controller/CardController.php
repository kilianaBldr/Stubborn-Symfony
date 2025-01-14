<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CardController extends AbstractController
{
    #[Route('/card', name: 'app_card')]
    public function index(): Response
    {
        //Simulation d'un panier pour l'exemple
        $cartItems = [
            ['name' => 'Sweatshirt 1', 'price' => 29.99, 'quantity' => 1 ],
        ];

        return $this->render('card/index.html.twig', [
            'cartItems' => $cartItems,
            'total' => array_reduce($cartItems, fn($total, $item) => $total + ($item['price'] * $item['quantity']), 0 ),
        ]);
    }
}
