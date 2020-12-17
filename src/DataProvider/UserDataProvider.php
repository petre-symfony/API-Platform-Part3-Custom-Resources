<?php
namespace App\DataProvider;


use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\User;

class UserDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface {
	private $collectionDataProvider;

	public function __construct(CollectionDataProviderInterface $collectionDataProvider){
		$this->collectionDataProvider = $collectionDataProvider;
	}

	public function getCollection(string $resourceClass, string $operationName = null, array $context = []) {
		/** @var User[] $users */
		$users = $this->collectionDataProvider->getCollection($resourceClass, $operationName, $context);

		dd($users);

		return $users;
	}

	public function supports(string $resourceClass, string $operationName = null, array $context = []): bool {
		return $resourceClass === User::class;
	}

}