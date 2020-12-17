<?php

namespace App\Validator;

use App\Entity\CheeseListing;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ValidIsPublishedValidator extends ConstraintValidator {
	private $entityManager;

	public function __construct(EntityManagerInterface $entityManager) {
		$this->entityManager = $entityManager;
	}

	public function validate($value, Constraint $constraint) {
		/* @var $constraint \App\Validator\ValidIsPublished */

		if (!$value instanceof CheeseListing){
			throw new \LogicException('Only CheeseListing is supported');
		}

		$originalData = $this->entityManager->getUnitOfWork()->getOriginalEntityData($value);
		dd($originalData);

		if (null === $value || '' === $value) {
			return;
		}

		// TODO: implement the validation here
		$this->context->buildViolation($constraint->message)
			->setParameter('{{ value }}', $value)
			->addViolation();
	}
}
