<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use JMS\Serializer\SerializerInterface; 


class ProductController extends AbstractController
{
    private $productRepository;
    private $entityManager;
    private $serializer;

    public function __construct(
        ProductRepository $productRepository,
        EntityManagerInterface $entityManager,
        SerializerInterface $serializer
    ) {
        $this->productRepository = $productRepository;
        $this->entityManager = $entityManager;
        $this->serializer = $serializer;
    }

    /**
     * @Route("/api/products", name="products", methods="GET")
     */
    public function products(SerializerInterface $serializer)
    {
        if ($this->getUser() !== null) {

                $products = $this->productRepository->findAll();
              
                $response = new Response($serializer->serialize($products, 'json'), Response::HTTP_OK);
                $response->setSharedMaxAge(3600);
                $response->headers->addCacheControlDirective('must-revalidate', true);

                return $response;
            }
        return new Response($serializer->serialize($products, 'json'),Response::HTTP_NOT_FOUND);
    }

    /**
     * @Route("api/products/{id}", name="product_show", methods="GET")
     */
    public function show(int $id, SerializerInterface $serializer)
    {

         $product = $this->productRepository->find($id);

         $response = new Response($this->serializer->serialize($product, 'json'),  Response::HTTP_OK);
         $response->setSharedMaxAge(3600);
         $response->headers->addCacheControlDirective('must-revalidate', true);

         if (!$product) {
             
            return new Response($this->serializer->serialize($product, 'json'),Response::HTTP_NOT_FOUND);
        }

        return $response;

        
    }
}
