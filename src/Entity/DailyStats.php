<?php
namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Action\NotFoundAction;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *   normalizationContext={"groups"={"daily-stats:read"}},
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
   * @Groups({"daily-stats:read"})
   */
  public $date;

  /**
   * @Groups({"daily-stats:read"})
   */
  public $totalVisitors;

  /**
   * @Groups({"daily-stats:read"})
   */
  public $mostPopularListings;

  /**
   * @ApiProperty(identifier=true)
   */
  public function getDateToString(){
    return $this->date->format('Y-m-d');
  }
}