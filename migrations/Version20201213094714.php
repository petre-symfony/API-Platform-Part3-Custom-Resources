<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201213094714 extends AbstractMigration {
  public function getDescription() : string {
    return '';
  }

  public function up(Schema $schema) : void {
    // this up() migration is auto-generated, please modify it to your needs
    $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, phone_number VARCHAR(50) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    $this->addSql('CREATE TABLE cheese_listing (id INT AUTO_INCREMENT NOT NULL, owner_id INT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, price INT NOT NULL, created_at DATETIME NOT NULL, is_published TINYINT(1) NOT NULL, INDEX IDX_356577D47E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    $this->addSql('CREATE TABLE cheese_notification (id INT AUTO_INCREMENT NOT NULL, cheese_listing_id INT NOT NULL, notification_text VARCHAR(255) NOT NULL, INDEX IDX_D33F5BC5B167220F (cheese_listing_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    $this->addSql('ALTER TABLE cheese_listing ADD CONSTRAINT FK_356577D47E3C61F9 FOREIGN KEY (owner_id) REFERENCES user (id)');
    $this->addSql('ALTER TABLE cheese_notification ADD CONSTRAINT FK_D33F5BC5B167220F FOREIGN KEY (cheese_listing_id) REFERENCES cheese_listing (id)');
  }

  public function down(Schema $schema) : void {
    // this down() migration is auto-generated, please modify it to your needs
    $this->addSql('ALTER TABLE cheese_notification DROP FOREIGN KEY FK_D33F5BC5B167220F');
    $this->addSql('DROP TABLE cheese_listing');
    $this->addSql('DROP TABLE cheese_notification');
    $this->addSql('DROP TABLE user');
  }
}
