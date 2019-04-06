<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;


class ProductController extends AbstractController
{
    private $productRepository;
    private $entityManager;
    private $serializer;

    public function __construct
    (
        ProductRepository $productRepository,
        EntityManagerInterface $entityManager,
        SerializerInterface $serializer
    ) 
    
    {
        $this->productRepository = $productRepository;
        $this->entityManager = $entityManager;
        $this->serializer = $serializer;
    }

    /**
     * @Route("", methods="GET")
     */
    public function index(): JsonResponse
    {
        $products = $this->productRepository->findAll();
        return $this->json($products, 200);
    }

    /**
     * @Route("/{id}", methods="GET")
     */
    public function show($id): Response
    {
        $product = $this->productRepository->find($id);
        if (!$product) {
            return $this->json('not found', 404);
        }
        //return $this->json($product, 200);
        return $this->jmsObjectToJson($product, 200);
    }
}
