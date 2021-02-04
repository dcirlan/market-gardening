<?php

namespace App\Controller;

use App\Repository\OrderRepository;
use App\Repository\BasketRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrderController extends AbstractController
{
    /**
     * @Route("/order", name="order")
     */
    public function index(): Response
    {
        return $this->render('order/index.html.twig', [
            'controller_name' => 'OrderController',
        ]);
    }

    /**
     * @Route("/post/basket/orders/{id}", name="orders_by_basket")
     */
    public function showOrdersByBasket($id, OrderRepository $orderRepository)
    {
        $orders = $orderRepository->findBy(['basket' => $id]);

        return $this->render('basket/ordersByBasket.html.twig', [
            'orders' => $orders,
        ]);
    }

}
