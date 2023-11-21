<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends AbstractController
{
    // ...

    /**
     * @Route("/products", name="product_list", methods={"GET"})
     */
    public function index(): Response
    {
        // Obtener la lista de productos desde la base de datos
        $products = $this->getDoctrine()->getRepository(Product::class)->findAll();

        // Serializar los productos a formato JSON y devolver la respuesta
        return $this->json($products);
    }

    /**
     * @Route("/products", name="product_create", methods={"POST"})
     */
    public function create(Request $request): Response
    {
        // Obtener los datos del cuerpo de la solicitud
        $data = json_decode($request->getContent(), true);

        // Crear una nueva instancia de la entidad Product
        $product = new Product();
        $product->setSku($data['sku']);
        $product->setProductName($data['product_name']);
        $product->setDescription($data['description']);
        //falta set created_at


        // Guardar el nuevo producto en la base de datos
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($product);
        $entityManager->flush();

        // Devolver una respuesta de éxito
        return $this->json(['message' => 'Producto creado!']);
    }

    /**
     * @Route("/products/{id}", name="product_update", methods={"PUT"})
     */
    public function update(Request $request, Product $product): Response
    {
        // Obtener los datos del cuerpo de la solicitud
        $data = json_decode($request->getContent(), true);

        $product->setSku($data['sku']);
        $product->setProductName($data['product_name']);
        $product->setDescription($data['description']);
        //falta updated at
        $product->setUpdatedAt($data['description']);

        // Guardar los cambios en la base de datos
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        // Devolver una respuesta de éxito
        return $this->json(['message' => 'Producto actualizado!']);
    }

    /**
     * @Route("/api/products", name="api_product_list", methods={"GET"})
     */
    public function listProducts(): JsonResponse
    {
        // Obtener la lista de productos desde la base de datos
        $products = $this->getDoctrine()->getRepository(Product::class)->findAll();

        // Serializar los productos a formato JSON y devolver la respuesta
        $data = [];

        foreach ($products as $product) {
            $data[] = [
                'sku' => $product->getSku(),
                'product_name' => $product->getProductName(),
                'description' => $product->getDescription(),

            ];
        }

        return $this->json($data);
    }

    // ...
}