<?php

namespace App\DTO;



use App\Entity\CheeseListing;
use App\Entity\User;
use Carbon\Carbon;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Component\Serializer\Annotation\Groups;

class CheeseListingOutput {
  /**
   * The title of this listing
   *
   * @Groups({"cheese:read", "user:read"})
   */
  public string $title;

  /**
   * @Groups({"cheese:read"})
   */
  public string $description;

  /**
   * @Groups({"cheese:read", "user:read"})
   */
  public int $price;

  public $createdAt;

  /**
   * @Groups({"cheese:read"})
   */
  public User $owner;

  public static function createFromEntity(CheeseListing $cheeseListing): self {
    $output = new CheeseListingOutput();
    $output->title = $cheeseListing->getTitle();
    $output->description = $cheeseListing->getDescription();
    $output->price = $cheeseListing->getPrice();
    $output->createdAt = $cheeseListing->getCreatedAt();
    $output->owner = $cheeseListing->getOwner();

    return $output;
  }

  /**
   * @Groups("cheese:read")
   */
  public function getShortDescription(): ?string {
    if (strlen($this->description) < 40) {
      return $this->description;
    }

    return substr($this->description, 0, 40).'...';
  }

  /**
   * How long ago in text that this cheese listing was added.
   *
   * @Groups("cheese:read")
   */
  public function getCreatedAtAgo(): string {
    return Carbon::instance($this->createdAt)->diffForHumans();
  }
}