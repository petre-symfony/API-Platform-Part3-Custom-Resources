<?php
namespace App\DTO;

use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;

class CheeseListingInput {
  /**
   * @Groups({"cheese:write", "user:write"})
   */
  public $title;
  /**
   * @Groups({"cheese:write", "user:write"})
   */
  public $price;
  /**
   * @Groups({"cheese:collection:post"})
   */
  public $owner;
  /**
   * @Groups({"cheese:write"})
   */
  public $isPublished;

  public $description;

  /**
   * The description of the cheese as raw text.
   *
   * @Groups({"cheese:write", "user:write"})
   * @SerializedName("description")
   */
  public function setTextDescription(string $description): self {
    $this->description = nl2br($description);

    return $this;
  }
}