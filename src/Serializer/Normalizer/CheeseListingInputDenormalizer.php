<?php
namespace App\Serializer\Normalizer;


use ApiPlatform\Core\Serializer\AbstractItemNormalizer;
use App\DTO\CheeseListingInput;
use Symfony\Component\Serializer\Normalizer\CacheableSupportsMethodInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use App\Entity\CheeseListing;

class CheeseListingInputDenormalizer implements DenormalizerInterface , CacheableSupportsMethodInterface {
  private ObjectNormalizer $objectNormalizer;

  public function __construct(ObjectNormalizer $objectNormalizer){

    $this->objectNormalizer = $objectNormalizer;
  }

  public function denormalize($data, string $type, string $format = null, array $context = []) {

    $context[AbstractItemNormalizer::OBJECT_TO_POPULATE] = $this->createDto($context);

    return $this->objectNormalizer->denormalize($data, $type, $format, $context);
  }

  public function supportsDenormalization($data, string $type, string $format = null) {
    return $type === CheeseListingInput::class;
  }

  public function hasCacheableSupportsMethod(): bool {
    return true;
  }

  private function createDto(array $context): CheeseListingInput {
    $entity = $context['object_to_populate'] ?? null;

    if ($entity && !$entity instanceof CheeseListing) {
      throw new \Exception(sprintf('Unexpected resource class "%s"', get_class($entity)));
    }

    return CheeseListingInput::createFromEntity($entity);
  }
}