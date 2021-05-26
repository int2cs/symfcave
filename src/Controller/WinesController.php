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
   * @Route("/wines/add", name="wines_add")
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
   * @Route("/wines/edit/{id}", name="wine_edit")
   */
  public function edit(Wines $product)
  {
    $this->addFlash('success', 'Modification effectué avec succès');

    return new Response('Editing Bottle');
  }

  /**
   * @Route("/wines/delete/{id}", name="wine_delete")
   */
  public function delete(Wines $product)
  {
    $entityManager = $this->getDoctrine()->getManager();

    $entityManager->remove($product);
    $entityManager->flush();

    $this->addFlash('success', 'Article supprimé avec succès!');

    return $this->redirectToRoute('wines_list');
  }
}
