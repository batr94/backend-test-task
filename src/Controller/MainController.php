<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class MainController extends AbstractController
{
    #[Route('/calculate-price', name: 'app_calculate_price')]
    public function calculatePrice()
    {
    }
}