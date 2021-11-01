<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\Cart\CartItemInList;
use App\DTO\Cart\SetCartItemRequest;
use App\Entity\CartItem;
use App\Entity\User;
use App\Repository\BikeRepository;
use App\Repository\CartItemRepository;
use Symfony\Component\HttpKernel\Exception\NotAcceptableHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\Security\Core\Security;

class CartService
{
    private $security;
    private $cartItemRepository;
    private $bikeRepository;

    public function __construct(Security $security, CartItemRepository $cartItemRepository, BikeRepository $bikeRepository)
    {
        $this->security = $security;
        $this->cartItemRepository = $cartItemRepository;
        $this->bikeRepository = $bikeRepository;
    }

    public function getCartItems(): array
    {
        $user = $this->security->getUser();

        if($user == null || !($user instanceof User)) throw new UnauthorizedHttpException();

        $cartItems = array_map(function(CartItem $item){
            return new CartItemInList($item);
        }, $user->getCartItems()->toArray());

        return $cartItems;
    }

    public function setCartItem(SetCartItemRequest $request): void
    {
        $user = $this->security->getUser();

        if($user == null || !($user instanceof User)) throw new UnauthorizedHttpException();

        $cartItem = $this->cartItemRepository->findByUserIdAndBikeId($user->getId(), $request->getBikeId());

        if($cartItem){
            if($request->getQuantity() <= 0 || $cartItem->getBike()->getCount() <= 0){
                $this->cartItemRepository->remove($cartItem);
                return;
            }

            $cartItem->setQuantity(min($request->getQuantity(), $cartItem->getBike()->getCount()));
        }else{
            if($request->getQuantity() <= 0) return;

            $cartItem = new CartItem();
            $cartItem->setUser($user);

            $bike = $this->bikeRepository->find($request->getBikeId());

            if(!$bike) throw new NotAcceptableHttpException();

            $cartItem->setBike($bike);

            $cartItem->setQuantity(min($request->getQuantity(), $bike->getCount()));
        }

        $this->cartItemRepository->save($cartItem);
    }
}