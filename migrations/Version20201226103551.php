<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201226103551 extends AbstractMigration {
  public function getDescription() : string {
      return '';
  }

  public function up(Schema $schema) : void {
    // this up() migration is auto-generated, please modify it to your needs
    $this->addSql('ALTER TABLE cheese_listing ADD uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\'');
    $this->addSql('UPDATE cheese_listing SET uuid = UUID()');
    $this->addSql('CREATE UNIQUE INDEX UNIQ_356577D4D17F50A6 ON cheese_listing (uuid)');
  }

  public function down(Schema $schema) : void {
    // this down() migration is auto-generated, please modify it to your needs
    $this->addSql('DROP INDEX UNIQ_356577D4D17F50A6 ON cheese_listing');
    $this->addSql('ALTER TABLE cheese_listing DROP uuid');
  }
}
