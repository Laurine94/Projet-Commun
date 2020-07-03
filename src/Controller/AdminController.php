<?php

namespace App\Controller;

use App\Entity\Legume;
use App\Entity\Categorie;
use App\Entity\Utilisateur;
use App\Entity\Favoris;
use App\Form\LegumeType;
use App\Form\CategorieType;
use App\Form\UtilisateurType;

use App\Entity\Commentaire;
use App\Form\CommentaireType;
use App\Repository\FavorisRepository;
use App\Repository\CategorieRepository;
use App\Repository\CommentaireRepository;
use App\Repository\UtilisateurRepository;
use App\Repository\LegumeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig', [
        ]);
    }

    /**
     * @Route("/admin/categories", name="admin_categories" , methods={"GET"})
     */
    public function categories(CategorieRepository $repository): Response
    {
        return $this->render('admin/categories.html.twig', [
            'categories' => $repository->findAll(),
            ]);
        }

      /**
     * @Route("/admin/utilisateurs", name="admin_utilisateurs" , methods={"GET"})
     */
    public function utilisateurs(UtilisateurRepository $repository): Response
    {
        return $this->render('admin/utilisateurs.html.twig', [
            'utilisateurs' => $repository->findAll(),
            ]);
    }
        
     /**
     * @Route("/admin/plantes", name="admin_plantes" , methods={"GET"})
     */
    public function plantes(LegumeRepository $repository): Response
    {
        return $this->render('admin/plantes.html.twig', [
            'plantes' => $repository->findAll(),
            ]);
    }

    
    /**
     * @Route("/newCategorie", name="admin_categorie_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $categorie = new Categorie();
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($categorie);
            $entityManager->flush();

            return $this->redirectToRoute('admin_categories');
        }

        return $this->render('admin/newCategorie.html.twig', [
            'categorie' => $categorie,
            'form' => $form->createView(),
        ]);
    }


     /**
     * @Route("/admin/categorie/{id}", name="admin_categorie", methods={"GET"})
     */
    public function showCategorie(Categorie $categorie): Response
    {
       
       return $this->render('admin/showCategorie.html.twig', [
            'categorie' => $categorie,
            'page'=>"cat"
        ]);
    }

    /**
     * @Route("/admin/utilisateur/{id}", name="admin_utilisateur", methods={"GET"})
     */
    public function showUtilisateur(Utilisateur $utilisateur): Response
    {
       
       return $this->render('admin/showUtilisateur.html.twig', [
            'utilisateur' => $utilisateur,
            'page'=>"utilisateur"
        ]);
    }
    
     /**
     * @Route("/admin/categorie/{id}/edit", name="admin_categorie_edit", methods={"GET","POST"})
     */
    public function editCategorie(Request $request, Categorie $categorie): Response
    {
       
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_categories');
        }

        return $this->render('admin\editCategorieAdmin.html.twig', [
            'categorie' => $categorie,
            'form' => $form->createView(),
            'page'=>"edit"
        ]);
    }
     /**
     * @Route("/admin/utilisateur/{id}/edit", name="admin_utilisateur_edit", methods={"GET","POST"})
     */
    public function editUtilisateur(Request $request, Utilisateur $utilisateur): Response
    {
       
        $form = $this->createForm(UtilisateurType::class, $utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_utilisateurs');
        }

        return $this->render('admin\editUtilisateurAdmin.html.twig', [
            'utilisateur' => $utilisateur,
            'form' => $form->createView(),
            'page'=>"edit"
        ]);
    }
     /**
     * @Route("/deleteCat/{id}", name="admin_categorie_delete", methods={"DELETE","GET"})
     */
    public function deleteCat(Request $request, Categorie $categorie): Response
    {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($categorie);
            $entityManager->flush();
  

        return $this->redirectToRoute('admin_categories');
    }
     /**
     * @Route("/deleteUser/{id}", name="admin_utilisateur_delete", methods={"DELETE","GET"})
     */
    public function deleteUser(Request $request, Utilisateur $utilisateur): Response
    {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($utilisateur);
            $entityManager->flush();
  

        return $this->redirectToRoute('admin_utilisateurs');
    }
}
