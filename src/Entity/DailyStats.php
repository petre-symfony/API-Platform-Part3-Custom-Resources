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

  public $date;

  public $totalVisitors;

  public $mostPopularListings;

  /**
   * @ApiProperty(identifier=true)
   */
  public function getDateToString(){
    return $this->date->format('Y-m-d');
  }
}