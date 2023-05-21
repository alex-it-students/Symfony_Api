<?php

use Faker\Provider\Base;

class MartialArtProvider extends Base
{
    protected static array $martialArtList = [
        'Koalate',
        'Judophin',
        'Tigrwondo',
        'Kung Furret',
        'Catoeira',
        'Krab Maga',
        'Aikidog',
        'Jiu-Jitsouris',
        'Mouette Thaï',
        'Cobra de fer',
    ];

    public function martialArt()
    {
        return static::randomElement(static::$martialArtList);
    }
}
