<?php
namespace App\ApiPlatform;

use ApiPlatform\Core\Serializer\Filter\FilterInterface;
use Symfony\Component\HttpFoundation\Request;

class DailyStatsDateFilter implements FilterInterface {
  public function apply(Request $request, bool $normalization, array $attributes, array &$context){
    $from = $request->query->get('from');
    if(!$from){
      return;
    }
    dd($from);
  }

  public function getDescription(string $resourceClass): array{
    return [
      'from' => [
        'property' => null,
        'type' => 'string',
        'required' => false,
        'openapi' => [
          'description' => 'From date e.g. 2020-09-01'
        ]
      ]
    ];
  }

}