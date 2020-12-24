<?php
namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\ApiPlatform\DailyStatsDateFilter;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *   normalizationContext={"groups"={"daily-stats:read"}},
 *   denormalizationContext={"groups"={"daily-stats:write"}},
 *   paginationItemsPerPage=7,
 *   itemOperations={
 *     "get",
 *     "put"
 *   },
 *   collectionOperations={"get"}
 * )
 * @ApiFilter(DailyStatsDateFilter::class)
 */
class DailyStats {

  /**
   * @Groups({"daily-stats:read"})
   */
  public $date;

  /**
   * @Groups({"daily-stats:read", "daily-stats:write"})
   */
  public $totalVisitors;

  /**
   * The 5 most popular cheese listings from this date!
   *
   * @var array<CheeseListing>|CheeseListing[]
   * @Groups({"daily-stats:read"})
   */
  public $mostPopularListings;

  /**
   * @param CheeseListing[] $mostPopularListings
   */
  public function __construct(\DateTimeInterface $date, int $totalVisitors, array $mostPopularListings){
    $this->date = $date;
    $this->totalVisitors = $totalVisitors;
    $this->mostPopularListings = $mostPopularListings;
  }


  /**
   * @ApiProperty(identifier=true)
   */
  public function getDateToString(){
    return $this->date->format('Y-m-d');
  }
}