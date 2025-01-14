<?php

namespace App\Controller;

use App\Repository\SweatshirtRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SweatshirtController extends AbstractController
{
    #[Route('/sweatshirt', name: 'app_sweatshirt')]
    public function index(SweatshirtRepository $SweatshirtRepository): Response
    {
        $sweatshirt = $SweatshirtRepository->findAll();

        return $this->render('sweatshirt/index.html.twig', [
            'sweatshirt' => 'SweatshirtController',
        ]);
    }
    #[Route('/sweatshirt/{id}', name: 'app_sweatshirtDetail')]
    public function detail(int $id, SweatshirtRepository $SweatshirtRepository): Response
    {
        $sweatshirt = $SweatshirtRepository->find($id);

        return $this->render('sweatshirt/detail.html.twig', [
            'sweatshirt' => $sweatshirt,
        ]);
    }

}
