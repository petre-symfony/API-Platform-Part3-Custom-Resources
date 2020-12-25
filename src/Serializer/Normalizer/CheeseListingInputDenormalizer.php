<?php
namespace App\Serializer\Normalizer;


use ApiPlatform\Core\Serializer\AbstractItemNormalizer;
use App\DTO\CheeseListingInput;
use Symfony\Component\Serializer\Normalizer\CacheableSupportsMethodInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class CheeseListingInputDenormalizer implements DenormalizerInterface , CacheableSupportsMethodInterface {
  private ObjectNormalizer $objectNormalizer;

  public function __construct(ObjectNormalizer $objectNormalizer){

    $this->objectNormalizer = $objectNormalizer;
  }

  public function denormalize($data, string $type, string $format = null, array $context = []) {
    $dto = new CheeseListingInput();
    $dto->title = 'I am set in the denormalizer';

    $context[AbstractItemNormalizer::OBJECT_TO_POPULATE] = $dto;

    return $this->objectNormalizer->denormalize($data, $type, $format, $context);
  }

  public function supportsDenormalization($data, string $type, string $format = null) {
    return $type === CheeseListingInput::class;
  }

  public function hasCacheableSupportsMethod(): bool {
    return true;
  }
}