<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210918132911 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE leisure_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE leisure_center (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, address VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE leisure_center_leisure_category (leisure_center_id INT NOT NULL, leisure_category_id INT NOT NULL, INDEX IDX_1788261C77458AFB (leisure_center_id), INDEX IDX_1788261CACA9AD4A (leisure_category_id), PRIMARY KEY(leisure_center_id, leisure_category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE leisure_center_leisure_category ADD CONSTRAINT FK_1788261C77458AFB FOREIGN KEY (leisure_center_id) REFERENCES leisure_center (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE leisure_center_leisure_category ADD CONSTRAINT FK_1788261CACA9AD4A FOREIGN KEY (leisure_category_id) REFERENCES leisure_category (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE leisure_center_leisure_category DROP FOREIGN KEY FK_1788261CACA9AD4A');
        $this->addSql('ALTER TABLE leisure_center_leisure_category DROP FOREIGN KEY FK_1788261C77458AFB');
        $this->addSql('DROP TABLE leisure_category');
        $this->addSql('DROP TABLE leisure_center');
        $this->addSql('DROP TABLE leisure_center_leisure_category');
    }
}
