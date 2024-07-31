<?php

declare(strict_types=1);

namespace App\Controller;

use App\DTO\CalculatePriceDTO;
use App\Service\CalculateProductPriceService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;

final class MainController extends AbstractController
{
    #[Route('/calculate-price', name: 'app_calculate_price', methods: ['POST'])]
    public function calculatePrice(
        #[MapRequestPayload]
        CalculatePriceDTO $calculatePriceRequestDTO,
        CalculateProductPriceService $calculateProductPriceService
    ): Response {
        return new Response('' . $calculateProductPriceService->calculate($calculatePriceRequestDTO));
    }
}