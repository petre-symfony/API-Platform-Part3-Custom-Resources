<?php

namespace App\DTO;



use Symfony\Component\Serializer\Annotation\Groups;

class CheeseListingOutput {
  /**
   * The title of this listing
   * 
   * @Groups({"cheese:read"})
   */
  public string $title;
}