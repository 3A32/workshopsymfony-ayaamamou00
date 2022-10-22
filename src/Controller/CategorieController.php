<?php

namespace App\Controller;
use App\Entity\Categorie;
use App\Form\CategorieType;
use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
class CategorieController extends AbstractController
{
    #[Route('/categorie', name: 'app_categorie')]
    public function index(): Response
    {
        return $this->render('categorie/index.html.twig', [
            'controller_name' => 'CategorieController',
        ]);
    }
    #[Route('/addCategorie',name:'app_addcategorie')]
    public function addCategorie(ManagerRegistry $doctrine, Request $request )
    { #$club=$thid->setDoctrine()->getRepository(ClubRepository)->findall()
        $categorie= new Categorie();
        $form=$this->createForm(CategorieType::class,$categorie);
        $form->handleRequest($request);
        if($form->isSubmitted())
{
    $em=$doctrine->getManager();
    $em->persist($categorie);
    $em->flush();
    return $this->redirectToRoute("app_addcategorie");
}
       
        return $this->renderForm("categorie/addCategorie.html.twig",array("formCategorie"=>$form));
    }

}
