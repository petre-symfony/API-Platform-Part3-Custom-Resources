<?php
namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ApiResource(
 *   itemOperations={},
 *   collectionOperations={"get"}
 * )
 */
class DailyStats {
  public $date;

  public $totalVisitors;

  public $mostPopularListings;
}