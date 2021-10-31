<?php

namespace App\Controller;

use App\Form\SetCartItemType;
use App\Service\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotAcceptableHttpException;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    private $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * @Route("/cart", name="cart_page")
     */
    public function index(): Response
    {
        $items = $this->cartService->getCartItems();

        dd($items);

        return $this->render('cart/index.html.twig', [
            'controller_name' => 'CartController',
        ]);
    }

    /**
     * @Route("/cart/set", name="cart_set", methods={"POST"})
     */
    public function setItem(Request $request): Response
    {
        $form = $this->createForm(SetCartItemType::class);
        $data = \json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
        $form->submit($data);

        if (!$form->isSubmitted() || !$form->isValid()) throw new NotAcceptableHttpException();

        $this->cartService->setCartItem($form->getData());

        return new JsonResponse(["message" => "ok"], Response::HTTP_OK);
    }
}
