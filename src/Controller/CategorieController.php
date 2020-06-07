<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategorieRepository;

class CategorieController extends AbstractController
{
    /**
     * @Route("/categorie", name="categorie")
     */
    public function liste(CategorieRepository $repo)
    {
        $categories=$repo->findAll();
        //dd($categories);
        return $this->render('categorie/liste.html.twig', [
            'categories' => $categories,
        ]);
    }
}
