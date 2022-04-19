<?php

namespace App\Crawler\StoreData;

interface StoreDataInterface
{
    public function saveData(array $data): bool;
}
