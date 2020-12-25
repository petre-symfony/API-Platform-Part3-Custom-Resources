<?php

namespace App\DataTransformer;


use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\DTO\CheeseListingOutput;
use App\Entity\CheeseListing;

class CheeseListingOutputDataTransformer implements DataTransformerInterface {
  public function transform($object, string $to, array $context = []){
    dd($object, $to);
  }

  public function supportsTransformation($data, string $to, array $context = []): bool{
    return $data instanceof CheeseListing && $to === CheeseListingOutput::class;
  }

}