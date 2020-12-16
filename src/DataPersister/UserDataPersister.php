<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Entity\User;
use Psr\Log\LoggerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserDataPersister implements DataPersisterInterface {
  private $decoratedDataPersister;
  private $userPasswordEncoder;
  private $logger;

  public function __construct(
    DataPersisterInterface $decoratedDataPersister,
    UserPasswordEncoderInterface $userPasswordEncoder,
    LoggerInterface $logger
  ) {
    $this->decoratedDataPersister = $decoratedDataPersister;
    $this->userPasswordEncoder = $userPasswordEncoder;
    $this->logger = $logger;
  }

  public function supports($data): bool {
    return $data instanceof User;
  }

  /**
   * @param User $data
   */
  public function persist($data) {
    if (!$data->getId()) {
      // take any actions for a new user
      // send registration email
      // integrate into some CRM or payment system
      $this->logger->info(sprintf('User %s just registered! Eureka!', $data->getEmail()));
    }

    if ($data->getPlainPassword()) {
      $data->setPassword(
        $this->userPasswordEncoder->encodePassword($data, $data->getPlainPassword())
      );
      $data->eraseCredentials();
    }

    $this->decoratedDataPersister->persist($data);
  }

  public function remove($data) {
    $this->decoratedDataPersister->remove($data);
  }
}
