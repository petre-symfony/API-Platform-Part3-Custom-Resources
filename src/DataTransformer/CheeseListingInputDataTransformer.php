<?php
namespace App\DataTransformer;


use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\DTO\CheeseListingInput;
use App\Entity\CheeseListing;

class CheeseListingInputDataTransformer implements DataTransformerInterface {
  /**
   * @param CheeseListingInput $input
   */
  public function transform($input, string $to, array $context = []){
    dump($input, $to, $context);

    return new CheeseListing();
  }

  public function supportsTransformation($data, string $to, array $context = []): bool {
    if ($data instanceof CheeseListing) {
      //already transformed
      return false;
    }

    return $to===CheeseListing::CLASS && ($context['input']['class'] ?? null) === CheeseListingInput::class;
  }

}