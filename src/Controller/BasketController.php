<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\Basket;
use App\Form\BasketType;
use App\Repository\OrderRepository;
use App\Repository\BasketRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/basket")
 */
class BasketController extends AbstractController
{
    /**
     * @Route("/", name="basket_index", methods={"GET"})
     */
    public function index(BasketRepository $basketRepository): Response
    {
        return $this->render('basket/index.html.twig', [
            'baskets' => $basketRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="basket_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $basket = new Basket();
        $form = $this->createForm(BasketType::class, $basket);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($basket);
            $entityManager->flush();

            return $this->redirectToRoute('basket_index');
        }

        return $this->render('basket/new.html.twig', [
            'basket' => $basket,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="basket_show", methods={"GET"})
     */
    public function show(Basket $basket, $id, OrderRepository $orderRepository): Response
    {
        $orders = $orderRepository->findBy(['basket' => $id]);

        return $this->render('basket/show.html.twig', [
            'basket' => $basket,
            'orders' => $orders,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="basket_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Basket $basket): Response
    {
        $form = $this->createForm(BasketType::class, $basket);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('basket_index');
        }

        return $this->render('basket/edit.html.twig', [
            'basket' => $basket,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="basket_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Basket $basket): Response
    {
        if ($this->isCsrfTokenValid('delete'.$basket->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($basket);
            $entityManager->flush();
        }

        return $this->redirectToRoute('basket_index');
    }


    /**
     * @Route("/post/basket/reserve/{id}", name="basket_reserve")
     */
    public function reserved($id, BasketRepository $basketRepository)
    {
        $time = new \DateTime();


        $order = new Order();

        $user = $this->getUser();
        $basket = $basketRepository->find($id);

        $order->setQuantity('1');
        $order->setUser($user);
        $order->setBasket($basket);
        $order->setOrderDate($time -> format('Y-m-d H:i'));
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($order);
        $entityManager->flush();

        return $this->redirectToRoute('basket_index');
    }
}
