<?php

namespace App\DataProvider;


use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\Pagination;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\DailyStats;
use App\Service\StatsHelper;

class DailyStatsProvider implements
	CollectionDataProviderInterface,
	RestrictedDataProviderInterface,
	ItemDataProviderInterface
{

	private $statsHelper;
	private $pagination;

	public function __construct(
		StatsHelper $statsHelper,
		Pagination $pagination
	){

		$this->statsHelper = $statsHelper;
		$this->pagination = $pagination;
	}

  public function getCollection(string $resourceClass, string $operationName = null){
		list($page, $offset, $limit) = $this->pagination
			->getPagination($resourceClass, $operationName);

    $paginator =  new DailyStatsPaginator(
    	$this->statsHelper,
			$page,
			$limit
		);

    $paginator->setFromDate(new \DateTime('2020-08-03'));

    return $paginator;
  }

	public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []){
		return $this->statsHelper->fetchOne($id);
	}

  public function supports(string $resourceClass, string $operationName = null, array $context = []): bool{
    return $resourceClass === DailyStats::class;
  }

}