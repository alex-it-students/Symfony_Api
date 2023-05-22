<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Repository\AnimalRepository;
use App\Repository\CountryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/animal')]
class AnimalController extends AbstractController
{
    #[Route('/', name: 'app_animal_index', methods: ['GET'])]
    public function index(AnimalRepository $animalRepository): Response
    {
        return $this->json($animalRepository->findAll());
    }

    #[Route('/', name: 'app_animal_new', methods: ['POST'])]
    public function new(Request $request, AnimalRepository $animalRepository,CountryRepository $countryRepository): Response
    {
        // récupérer les data de la requête
        $data = json_decode($request->getContent(), true);

        $country = $countryRepository->find($data['Country']);

        $animal = new Animal();
        $animal->setName($data['Name']);
        $animal->setCountry($country);
        $animal->setAverageSize($data['AverageSize']);
        $animal->setAverageLifeExpectency($data['AverageLifeExpectency']);
        $animal->setPhoneNumber($data['PhoneNumber']);
        $animal->setMartialArt($data['MartialArt']);
        $animalRepository->save($animal, true);

        // on retourne le json en réponse
        return $this->json($animal);
    }

    #[Route('/{id}', name: 'app_animal_show', methods: ['GET'])]
    public function show(AnimalRepository $animalRepository, int $id): Response
    {
        $animal = $animalRepository->find($id);
        return $this->json($animal);
    }

    #[Route('/{id}', name: 'app_animal_edit', methods: ['PUT'])]
    public function edit(Request $request, AnimalRepository $animalRepository, int $id, CountryRepository $countryRepository): Response
    {
        // récupérer les data de la requête
        $data = json_decode($request->getContent(), true);

        $country = $countryRepository->find($data['Country']);

        $animal = $animalRepository->find($id);
        $animal->setName($data['Name']);
        $animal->setCountry($country);
        $animal->setAverageSize($data['AverageSize']);
        $animal->setAverageLifeExpectency($data['AverageLifeExpectency']);
        $animal->setPhoneNumber($data['PhoneNumber']);
        $animal->setMartialArt($data['MartialArt']);
        $animalRepository->save($animal, true);
        return $this->json($animal);
    }

    #[Route('/{id}', name: 'app_animal_update', methods: ['PATCH'])]
    public function update(Request $request, AnimalRepository $animalRepository, int $id): Response
    {
        // récupérer les data de la requête
        $data = json_decode($request->getContent(), true);
        $animal = $animalRepository->find($id);
        $animal->setName($data['Name']);
        $animalRepository->save($animal, true);
        return $this->json($animal);
    }

    #[Route('/{id}', name: 'app_animal_delete', methods: ['DELETE'])]
    public function delete(AnimalRepository $animalRepository, int $id): Response
    {
        $animal = $animalRepository->find($id);
        $animalRepository->remove($animal, true);
        return $this->json(null, 204);
    }
}
