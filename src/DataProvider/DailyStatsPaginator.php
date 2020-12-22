<?php

namespace App\DataProvider;


use ApiPlatform\Core\DataProvider\PaginatorInterface;
use Exception;
use Traversable;

class DailyStatsPaginator implements PaginatorInterface, \IteratorAggregate {
	private $dailyStatsIterator;

	public function getLastPage(): float{
		return 2;
	}

	public function getTotalItems(): float{
		return 25;
	}


	public function getCurrentPage(): float{
		return 1;
	}

	public function getItemsPerPage(): float{
		return 10;
	}

	public function count(){
		return $this->getTotalItems();
	}

	public function getIterator(){
		if ($this->dailyStatsIterator === null) {
			// todo - actually go "load" the stas
			$this->dailyStatsIterator = new \ArrayIterator([]);
		}

		return $this->dailyStatsIterator;
	}


}