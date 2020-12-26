<?php
namespace App\DataTransformer;


use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use ApiPlatform\Core\Serializer\AbstractItemNormalizer;
use App\DTO\CheeseListingInput;
use App\Entity\CheeseListing;

class CheeseListingInputDataTransformer implements DataTransformerInterface {
  /**
   * @param CheeseListingInput $input
   */
  public function transform($input, string $to, array $context = []){

    $cheeseListing = $context[AbstractItemNormalizer::OBJECT_TO_POPULATE] ?? null;

    return $input->createOrUpdateEntity($cheeseListing);
  }

  public function supportsTransformation($data, string $to, array $context = []): bool {
    if ($data instanceof CheeseListing) {
      //already transformed
      return false;
    }

    return $to===CheeseListing::CLASS && ($context['input']['class'] ?? null) === CheeseListingInput::class;
  }

}