<?php

namespace App\DTO;



use Symfony\Component\Serializer\Annotation\Groups;

class CheeseListingOutput {
  /**
   * @Groups({"cheese:read"})
   */
  public $title;
}