<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211028152413 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bike (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, name VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, description LONGTEXT NOT NULL, count INT NOT NULL, INDEX IDX_4CBC378012469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bike_photo (id INT AUTO_INCREMENT NOT NULL, bike_id INT NOT NULL, path VARCHAR(255) NOT NULL, INDEX IDX_BD1A9D4CD5A4816F (bike_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bike ADD CONSTRAINT FK_4CBC378012469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE bike_photo ADD CONSTRAINT FK_BD1A9D4CD5A4816F FOREIGN KEY (bike_id) REFERENCES bike (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bike_photo DROP FOREIGN KEY FK_BD1A9D4CD5A4816F');
        $this->addSql('ALTER TABLE bike DROP FOREIGN KEY FK_4CBC378012469DE2');
        $this->addSql('DROP TABLE bike');
        $this->addSql('DROP TABLE bike_photo');
        $this->addSql('DROP TABLE category');
    }
}
