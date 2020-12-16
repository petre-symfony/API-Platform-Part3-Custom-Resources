<?php


namespace App\DataPersister;


use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Entity\CheeseListing;

class CheeseListingDataPersister implements DataPersisterInterface {
  private $decoratedDataPersister;

  public function __construct($decoratedDataPersister) {

    $this->decoratedDataPersister = $decoratedDataPersister;
  }

  public function supports($data): bool {
    return $data instanceof CheeseListing;
  }

  public function persist($data) {
    $this->decoratedDataPersister->persist($data);
  }

  public function remove($data) {
    $this->decoratedDataPersister->remove($data);
  }
}