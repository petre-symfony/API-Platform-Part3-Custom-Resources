<?php
namespace App\DataTransformer;


use ApiPlatform\Core\DataTransformer\DataTransformerInterface;

class CheeseListingInputDataTransformer implements DataTransformerInterface {
  public function transform($object, string $to, array $context = []){
    // TODO: Implement transform() method.
  }

  public function supportsTransformation($data, string $to, array $context = []): bool {
    dump($data, $to, $context);

    return false;
  }

}