<?php
namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ApiResource()
 */
class DailyStats {
  public $date;

  public $totalVisitors;

  public $mostPopularListings;
}