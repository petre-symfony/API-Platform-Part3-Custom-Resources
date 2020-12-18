<?php
namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Action\NotFoundAction;

/**
 * @ApiResource(
 *   itemOperations={
 *     "get"={
 *       "method"="GET",
 *       "controller"=NotFoundAction::class,
 *       "read"=false,
 *       "output"=false
 *     }
 *   },
 *   collectionOperations={"get"}
 * )
 */
class DailyStats {
  /**
   * @ApiProperty(identifier=true)
   */
  public $date;

  public $totalVisitors;

  public $mostPopularListings;
}