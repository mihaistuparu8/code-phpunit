<?php


namespace AppBundle\Factory;


use AppBundle\Entity\Dinosaur;

class DinosaurFactory
{
    public function growVelociraptor(int $length): Dinosaur
    {
        return $this->createDinosaur('Velociraptor', true, $length);
    }

    public function growFromSpecification(string $specification): Dinosaur
    {
        $codeName = 'InG' . random_int(1, 99999);
        $length = $this->getLengthFromSpecification($specification);
        $isCarnivorous = stripos($specification, 'carnivorous') !== false ? true : false;
        $dinosaur = $this->createDinosaur($codeName, $isCarnivorous, $length);

        return $dinosaur;
    }

    private function createDinosaur(string $genus, bool $isCarnivorous, int $length)
    {
        $dinosaur = new Dinosaur($genus, $isCarnivorous);
        $dinosaur->setLength($length);

        return $dinosaur;
    }

    private function getLengthFromSpecification(string $specification): int
    {
        $length = random_int(1, Dinosaur::LARGE - 1);

        $searchSpecifiaction = [
            'huge' => ['min' => Dinosaur::HUGE, 'max' => 100],
            'omg' => ['min' => Dinosaur::HUGE, 'max' => 100],
            '😱' => ['min' => Dinosaur::HUGE, 'max' => 100],
            'large' => ['min' => Dinosaur::LARGE, 'max' => Dinosaur::HUGE - 1],
        ];

        foreach(array_keys($searchSpecifiaction) as $searchText) {
            if (stripos($specification, $searchText) !== false) {
                $lengthValues = $searchSpecifiaction[$searchText];
                $length = random_int($lengthValues['min'], $lengthValues['max']);
                break;
            }
        }
        return $length;
    }
}