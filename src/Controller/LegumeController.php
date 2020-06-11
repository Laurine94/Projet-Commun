<?php

namespace App\Controller;

use App\Entity\Legume;
use App\Entity\Categorie;
use App\Entity\Favoris;
use App\Form\LegumeType;
use App\Entity\Commentaire;
use App\Form\CommentaireType;
use App\Repository\FavorisRepository;
use App\Repository\CommentaireRepository;
use App\Repository\LegumeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/legume")
 */
class LegumeController extends AbstractController
{
    /**
     * @Route("/", name="legume_index", methods={"GET"})
     */
    public function index(LegumeRepository $legumeRepository): Response
    {
        return $this->render('legume/index.html.twig', [
            'legumes' => $legumeRepository->findAll(),
            'page'=>"tous"
            ]);
        }
        
        /**
        * @Route("/favoris", name="legumes_favoris", methods={"GET","POST"})
        */
        public function voirFavoris(FavorisRepository $repo,LegumeRepository $repoLeg): Response
        {
          $idFav=$repo->getAllFav($this->getUser()->getId());
          $tabFav=array();
          $tab=array();
          for($i=0;$i<sizeof($idFav);$i++){
   
              $favoris=$repoLeg->findById($idFav[$i]);
              $tabFav[$i]=$favoris;
   
              $tab[$i]=$tabFav[$i][0];
          }
          

          return $this->render('legume/index.html.twig', [
              'legumes' => $tab,
              'page'=>"favoris"
          ]);
        }


    /**
     * @Route("/ex/{id}", name="ex", methods={"GET"})
     */
    public function ex(Legume $legume): Response
    {
        
        return $this->render('legume/ex.html.twig', [
            'legume' => $legume,
            'ba'=>$legume->getBonneAsso()
        ]);
    }

    /**
     * @Route("/new", name="legume_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $legume = new Legume();
        $form = $this->createForm(LegumeType::class, $legume);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($legume);
            $entityManager->flush();

            return $this->redirectToRoute('legume_index');
        }

        return $this->render('legume/new.html.twig', [
            'legume' => $legume,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="legume_show", methods={"POST","GET"})
     */
    public function show(Request $request,Legume $legume,LegumeRepository $repo,CommentaireRepository $repoCom,FavorisRepository $repoFav): Response
    {
        $commentaire = new Commentaire();
        $form = $this->createForm(CommentaireType::class, $commentaire);
        $form->handleRequest($request);


       $idBonnesAssos=$repo->getBonneAsso($legume->getId());
       $tabBonnesAssos=array();
       $tabBA=array();
       $tabMA=array();
       for($i=0;$i<sizeof($idBonnesAssos);$i++){

           $bonneAsso=$repo->findById($idBonnesAssos[$i]);
           $tabBonnesAssos[$i]=$bonneAsso;

           $tabBA[$i]=$tabBonnesAssos[$i][0];
       }
       $idMauvaisesAssos=$repo->getMauvaiseAsso($legume->getId());
       $tabMauvaisesAssos=array();
       for($i=0;$i<sizeof($idMauvaisesAssos);$i++){

           $mauvaiseAsso=$repo->findById($idMauvaisesAssos[$i]);
           $tabMauvaisesAssos[$i]=$mauvaiseAsso;
           $tabMA[$i]=$tabMauvaisesAssos[$i][0];
       }

       if ($this->getUser()) {
           //verification si le legume est en favoris
           if ($repoFav->getfav($legume->getId(),$this->getUser()->getId())) {
               $fav="true";
           }
           else{
               $fav="false";
           }
       }
       else{
           $fav="";
       }
    //On cherche tout les commentaire de ce legume
       $commentaires=$repoCom->findAllByLegume($legume->getId());

       if ($form->isSubmitted() && $form->isValid()) {
        $entityManager = $this->getDoctrine()->getManager();
        $commentaire->setCreatedAt(new \DateTime('now'));
        $commentaire->setIdLegume($legume);
        $commentaire->setIdUtilisateur($this->getUser());
        $entityManager->persist($commentaire);
        $entityManager->flush();

        return $this->redirectToRoute('legume_show',['id'=>$legume->getId()]);
    }
       return $this->render('legume/show.html.twig', [
            'legume' => $legume,
            'bonnesAssos'=>$tabBA,
            'mauvaisesAssos'=>$tabMA,
            'fav'=>$fav,
            'form' => $form->createView(),
            'commentaires'=>$commentaires
        ]);
    }
    /**
     * @Route("/liste_par_cat/{id}", name="legume_show_by_cat", methods={"GET"})
     */
    public function showByCat(Categorie $categorie,LegumeRepository $repo): Response
    {
       
       $plantes=$repo->getPlantesByCategorie($categorie->getId());
      
       return $this->render('legume/index.html.twig', [
            'legumes' => $plantes,
            'page'=>'parCat'
        ]);
    }

    /**
     * @Route("/{id}/edit", name="legume_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Legume $legume): Response
    {
        $form = $this->createForm(LegumeType::class, $legume);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('legume_index');
        }

        return $this->render('legume/edit.html.twig', [
            'legume' => $legume,
            'form' => $form->createView(),
        ]);
    }

    
    /**
     * @Route("/{id}/mettreFav", name="legume_mettre_favoris", methods={"GET","POST"})
     */
    public function mettreFavoris(Legume $legume): Response
    {
        $fav=new Favoris();
        $fav->setIdUtilisateur($this->getUser());
        $fav->setIdLegume($legume);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($fav);
        $entityManager->flush();

        return $this->redirectToRoute('legume_show',['id'=>$legume->getId()]);
    }

      /**
     * @Route("/{id}/retirerFav", name="legume_retirer_favoris", methods={"GET","POST"})
     */
    public function retirerFavoris(Legume $legume,FavorisRepository $repo): Response
    {
        $idFav=$repo->getfav($legume->getId(),$this->getUser()->getId());
        //dd($repo->findById($idFav));
        $fav=$repo->findById($idFav);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($fav[0]);
        $entityManager->flush();

        return $this->redirectToRoute('legume_show',['id'=>$legume->getId()]);
    }



    /**
     * @Route("/{id}", name="legume_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Legume $legume): Response
    {
        if ($this->isCsrfTokenValid('delete'.$legume->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($legume);
            $entityManager->flush();
        }

        return $this->redirectToRoute('legume_index');
    }
   
    
    

}
