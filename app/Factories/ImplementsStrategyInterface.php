<?php


namespace App\Factories;


interface ImplementsStrategyInterface
{

    public function getInstance(string $strategy);
}
