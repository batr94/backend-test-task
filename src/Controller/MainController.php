<?php

declare(strict_types=1);

namespace App\Controller;

use App\DTO\CalculatePriceDTO;
use App\DTO\PurchaseRequestDTO;
use App\Service\CalculateProductPriceService;
use App\Service\PurchaseService;
use Doctrine\ORM\EntityNotFoundException;
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
        return new Response((string) $calculateProductPriceService->calculate($calculatePriceRequestDTO));
    }

    #[Route('/purchase', name: 'app_purchase', methods: ['POST'])]
    public function purchase(
        #[MapRequestPayload]
        PurchaseRequestDTO $purchaseRequestDTO,
        PurchaseService $purchaseService
    ): Response {
        try {
            $purchaseService->purchase($purchaseRequestDTO);

            return new Response('');
        } catch (EntityNotFoundException $exception) {
            return new Response($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        } catch (\Throwable $exception) {
            return new Response($exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}