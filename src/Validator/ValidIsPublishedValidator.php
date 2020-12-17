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

		$previousIsPublished = $originalData['isPublished'] ?? false;
		if ($previousIsPublished === $value->getIsPublished()) {
			// isPublished didn't change
			return;
		}

		if ($value->getIsPublished()) {
		  // we are publishing

			if (strlen($value->getDescription()) < 100) {
				$this->context->buildViolation('Cannot publish: description is too short')
					->atPath('description')
					->addViolation();
			}

			return;
		}

	}
}
