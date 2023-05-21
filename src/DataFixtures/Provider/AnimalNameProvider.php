<?php

use Faker\Provider\Base;

class AnimalNameProvider extends Base
{
    protected static array $animalName = [
        'Raymond le caméléon',
        'Gérard le lézard',
        'Léon le lion',
        'Gilou le caribou',
        'Bernard le canard',
        'Julio le mulot',
        'Lucien le chien',
        'Suzette la mouette',
        "Ferdinand l'éléphant",
        'Nicolas le boa',
        'Manue la tortue',
        'Zachary la souris',
    ];

    public function animalName()
    {
        return static::randomElement(static::$animalName);
    }
}
