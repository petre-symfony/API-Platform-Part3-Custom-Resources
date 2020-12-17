<?php
namespace App\DataProvider;


use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\User;
use Symfony\Component\Security\Core\Security;

class UserDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface {
	private $collectionDataProvider;
	private $security;

	public function __construct(
		CollectionDataProviderInterface $collectionDataProvider,
		Security $security
	){
		$this->collectionDataProvider = $collectionDataProvider;
		$this->security = $security;
	}

	public function getCollection(string $resourceClass, string $operationName = null, array $context = []) {
		/** @var User[] $users */
		$users = $this->collectionDataProvider->getCollection($resourceClass, $operationName, $context);

		$currentUser = $this->security->getUser();
		foreach ($users as $user){
			$user->setIsMe($currentUser === $user);
		}

		return $users;
	}

	public function supports(string $resourceClass, string $operationName = null, array $context = []): bool {
		return $resourceClass === User::class;
	}

}