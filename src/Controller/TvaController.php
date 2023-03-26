<?php

namespace App\Controller;

use App\Form\TvaType;
use App\Service\TvaService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TvaController extends AbstractController
{
    #[Route('/tva', name: 'app_tva')]
    public function index(Request $request, TvaService $tvaService): Response
{
    $form = $this->createForm(TvaType::class );
    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid()){
        $data = $form->getData();
        $data['tva']=$data['prix']*0.2;

        $data['tva']=$tvaService->calcul($data['prix']);
        
    
        return $this->render('tva/traitement.html.twig', [
            'mes_donnes' => $data,
            
        ]);
    }
    
    // Ajouter cette ligne pour retourner une réponse par défaut
    return $this->render('tva/index.html.twig', [
        'form' => $form->createView(),
    ]);
}
}
