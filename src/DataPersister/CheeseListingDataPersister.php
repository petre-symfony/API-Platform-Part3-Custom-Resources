<?php


namespace App\DataPersister;


use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Entity\CheeseListing;
use Doctrine\ORM\EntityManagerInterface;

class CheeseListingDataPersister implements DataPersisterInterface {
  private $decoratedDataPersister;
  private $entityManager;

  public function __construct(
    $decoratedDataPersister,
    EntityManagerInterface $entityManager
  ) {

    $this->decoratedDataPersister = $decoratedDataPersister;
    $this->entityManager = $entityManager;
  }

  public function supports($data): bool {
    return $data instanceof CheeseListing;
  }

  /**
   * @param CheeseListing $data
   */
  public function persist($data) {
    $originalData = $this->entityManager->getUnitOfWork()->getOriginalEntityData($data);
    dump($originalData);
    if ($data->getIsPublished()) {
      //hmm, not enough to know that it was JUST published
    }

    $this->decoratedDataPersister->persist($data);
  }

  public function remove($data) {
    $this->decoratedDataPersister->remove($data);
  }
}