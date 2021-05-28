<?php


namespace App\Controller;

use App\Entity\Wines;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WinesController extends AbstractController
{

  /**
   * @Route("/", name="wines_list")
   */
  public function list()
  {
    $products = $this->getDoctrine()->getRepository(Wines::class)->findAll();

    return $this->render('winesList.twig', [
      'products' => $products
    ]);
  }

  /**
   * @Route("/show/{id}", name="show_one")
   */
  public function showOne(Wines $product)
  {
    // $product = $this->getDoctrine()->getRepository(Wines::class)->find($product)

    return $this->render('wineShow.twig', [
      'product' => $product
      ]);
  }


  /**
   * @Route("/admin/wine/add", name="wines_add")
   */
  public function add(Request $data)
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

    $this->addFlash('success', 'Ajout effectué avec succès ');

    return $this->redirectToRoute('wines_list');
  }

  /**
   * @Route("/admin/wine/get/{id}", name="wine_get_info")
   */
  public function getInfo(Wines $product)
  {
    return $this->json($product, 200);
  }
  /**
   * @Route("/admin/wine/edit/{id}", name="wine_edit")
   */
  public function edit(Wines $product, Request $request)
  {
    $entityManager = $this->getDoctrine()->getManager();

    $product->setName($request->request->get('name'))
      ->setCountry($request->request->get('country'))
      ->setRegion($request->request->get('region'))
      ->setMillesime($request->request->get('millesime'))
      ->setCepages($request->request->get('cepages'))
      ->setDescription($request->request->get('description'))
      ->setPicture($request->request->get('formFile'));

    $entityManager->persist($product);
    $entityManager->flush();

    $this->addFlash('success', 'Mise à jour éffectué avec succès.');
    return $this->redirectToRoute('wines_list');
  }

  /**
   * @Route("/admin/wine/delete/{id}", name="wine_delete")
   */
  public function delete(Wines $product)
  {
    $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
    
    $entityManager = $this->getDoctrine()->getManager();

    $entityManager->remove($product);
    $entityManager->flush();

    $this->addFlash('success', 'Article supprimé avec succès!');

    return $this->redirectToRoute('wines_list');
  }
}
