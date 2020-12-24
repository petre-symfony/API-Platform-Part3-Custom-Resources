<?php

namespace App\DataProvider;


use ApiPlatform\Core\DataProvider\PaginatorInterface;
use App\Service\StatsHelper;
use Exception;
use Traversable;

class DailyStatsPaginator implements PaginatorInterface, \IteratorAggregate {
	private $dailyStatsIterator;
	private $statsHelper;
	private $currentPage;
	private $maxResults;
  /**
   * @var \DateTimeInterface|null
   */
  private $fromDate;

	public function __construct(
		StatsHelper $statsHelper,
		int $currentPage,
		int $maxResults
	) {

		$this->statsHelper = $statsHelper;
		$this->currentPage = $currentPage;
		$this->maxResults = $maxResults;
	}

	public function getLastPage(): float{
		return ceil($this->getTotalItems() / $this->getItemsPerPage()) ?: 1;
	}

	public function getTotalItems(): float{
		return $this->statsHelper->count();
	}


	public function getCurrentPage(): float{
		return $this->currentPage;
	}

	public function getItemsPerPage(): float{
		return $this->maxResults;
	}

	public function count(){
		return iterator_count($this->getIterator());
	}

	public function getIterator(){
		if ($this->dailyStatsIterator === null) {
			$offset = (($this->getCurrentPage() - 1) * $this->getItemsPerPage());

			$criteria = [];
			if($this->fromDate){
			  $criteria['from'] = $this->fromDate;
      }
			$this->dailyStatsIterator = new \ArrayIterator(
				$this->statsHelper->fetchMany(
					$this->getItemsPerPage(),
					$offset,
          $criteria
				)
			);
		}

		return $this->dailyStatsIterator;
	}

  /**
   * @param \DateTimeInterface|null $fromDate
   */
  public function setFromDate(\DateTimeInterface $fromDate): void{
    $this->fromDate = $fromDate;
  }

}