<?php

namespace App\Controller;

use App\Entity\Country;
use App\Repository\CountryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/country')]
class CountryController extends AbstractController
{
    #[Route('/', name: 'app_country_index', methods: ['GET'])]
    function index(CountryRepository $countryRepository): Response {

        $countries = $countryRepository->findAll();
        return $this->json($countries);
    }

    #[Route('/{id}', name: 'app_country_detail', methods: ['GET'])]
    function detail(CountryRepository $countryRepository, int $id): Response {
        $country = $countryRepository->find($id);
        return $this->json($country);
    }

    #[Route('/new', name: 'app_country_new', methods: ['POST'])]
    function new(Request $request, $countryRepository): Response {

        // on récupère les données de la requête
        $data = json_decode($request->getContent(), true);

        $country = new Country();

        // on hydrate l'objet
        $country->setName($data['name']);
        $country->setIsoCode($data['isoCode']);
        // on sauvegarde en base
        $countryRepository->save($country, true);
        return $this->json($country);
    }

    #[Route('/edit/{id}', name: 'app_country_edit', methods: ['PUT'])]
    function edit(Request $request, CountryRepository $countryRepository, int $id): Response {
        // on récupère les données de la requête
        $data = json_decode($request->getContent(), true);
        $country = $countryRepository->find($id);
        // on hydrate l'objet
        $country->setName($data['name']);
        $country->setIsoCode($data['isoCode']);
        // on sauvegarde en base
        $countryRepository->save($country, true);
        return $this->json($country);
    }

    // créer une route pour mettre à jour le nom d'un pays
    #[Route('/update/{id}', name: 'app_country_update', methods: ['PATCH'])]
    function update(Request $request, CountryRepository $countryRepository, int $id): Response {
        // on récupère les données de la requête
        $data = json_decode($request->getContent(), true);
        $country = $countryRepository->find($id);
        // on hydrate l'objet
        $country->setName($data['name']);
        // on sauvegarde en base
        $countryRepository->save($country, true);
        return $this->json($country);
    }

    #[Route('/{id}', name: 'app_country_delete', methods: ['DELETE'])]
    function delete(CountryRepository $countryRepository, int $id): Response {
        $country = $countryRepository->find($id);
        $countryRepository->remove($country, true);
        return $this->json(null, 204);
    }
}
