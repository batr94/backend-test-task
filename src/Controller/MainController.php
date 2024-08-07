<?php

declare(strict_types=1);

namespace App\Controller;

use App\DTO\CalculatePriceDTO;
use App\DTO\PurchaseRequestDTO;
use App\Service\CalculateProductPriceService;
use App\Service\PurchaseService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;

final class MainController extends AbstractController
{
    #[Route('/calculate-price', name: 'app_calculate_price', methods: ['POST'])]
    public function calculatePrice(
        #[MapRequestPayload(validationFailedStatusCode: Response::HTTP_BAD_REQUEST)]
        CalculatePriceDTO $calculatePriceRequestDTO,
        CalculateProductPriceService $calculateProductPriceService
    ): Response {
        return $this->json($calculateProductPriceService->calculate($calculatePriceRequestDTO));
    }

    #[Route('/purchase', name: 'app_purchase', methods: ['POST'])]
    public function purchase(
        #[MapRequestPayload(validationFailedStatusCode: Response::HTTP_BAD_REQUEST)]
        PurchaseRequestDTO $purchaseRequestDTO,
        PurchaseService $purchaseService
    ): Response {
        $purchaseService->purchase($purchaseRequestDTO);

        return new Response();
    }
}