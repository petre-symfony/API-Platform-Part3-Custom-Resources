<?php
namespace App\ApiPlatform;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\AbstractFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use Doctrine\ORM\QueryBuilder;

class CheeseSearchFilter extends AbstractFilter {
  protected function filterProperty(string $property, $value, QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, string $operationName = null){
    dd($property, $value);
  }

  public function getDescription(string $resourceClass): array {
    return [
      'search' => [
        'property' => null,
        'type' => 'string',
        'required' => false,
        'openapi' => [
          'description' => 'search across multiple fields'
        ]
      ]
    ];
  }

}