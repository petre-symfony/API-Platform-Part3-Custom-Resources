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
    if (isset($context[AbstractItemNormalizer::OBJECT_TO_POPULATE])) {
      $cheeseListing = $context[AbstractItemNormalizer::OBJECT_TO_POPULATE];
    } else {
      $cheeseListing = new CheeseListing($input->title);
    }

    $cheeseListing->setDescription($input->description);
    $cheeseListing->setPrice($input->price);
    $cheeseListing->setOwner($input->owner);
    $cheeseListing->setIsPublished($input->isPublished);

    return $cheeseListing;
  }

  public function supportsTransformation($data, string $to, array $context = []): bool {
    if ($data instanceof CheeseListing) {
      //already transformed
      return false;
    }

    return $to===CheeseListing::CLASS && ($context['input']['class'] ?? null) === CheeseListingInput::class;
  }

}