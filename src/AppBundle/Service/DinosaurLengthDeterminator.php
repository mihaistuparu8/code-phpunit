<?php


namespace AppBundle\Service;


use AppBundle\Entity\Dinosaur;

class DinosaurLengthDeterminator
{
    public function getLengthFromSpecification(string $specification): int
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