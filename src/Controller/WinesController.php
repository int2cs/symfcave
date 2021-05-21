<?php


namespace App\Controller;

use App\Entity\Wines;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WinesController extends AbstractController
{

  /**
   * @Route("/wines/list", name="wines_list")
   */
  public function list(): Response
  {
    $products = $this->getDoctrine()->getRepository(Wines::class)->findAll();
    // dd($products);

    return $this->render('winesList.twig', [
      'connected' => true,
      'products' => $products
    ]);
  }


  /**
   * @Route("/wines/add", name="wines_add")
   */
  public function add(Request $data): Response
  {
    $entityManager = $this->getDoctrine()->getManager();

    // $product = new Wines();
    // $form = $this->createFormBuilder($product)
    //               ->add('name')
    //               ->add('country')
    //               ->add('region')
    //               ->add('millesime')
    //               ->add('cepages')
    //               ->getForm();

    //   return $this->render('/', [
    //     'form' => $form->createView()
    //   ]);

    $product = new Wines();
    $product->setName($data->request->get('name'))
      ->setCountry($data->request->get('country'))
      ->setRegion($data->request->get('region'))
      ->setMillesime($data->request->get('millesime'))
      ->setCepages($data->request->get('cepages'))
      ->setDescription($data->request->get('description'))
      ->setPicture($data->request->get('formFile'));


    $entityManager->persist($product);
    $entityManager->flush();

    return new Response('Entrée sauvegardé !');
  }

  // public function list($id = 1): Response
  // {
  //   $product = $this->getDoctrine()->getRepository(Wines::class)->find($id);
  //   return $this->render('winesList.twig', [
  //     'connected' => true,
  //     'name' => $product->getName()
  //   ]);
  // }
}
