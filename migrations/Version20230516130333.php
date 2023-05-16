<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230516130333 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animal ADD country_id INT NOT NULL, DROP country, CHANGE martial_art martial_art VARCHAR(255) NOT NULL, CHANGE phone_number phone_number VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231FF92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('CREATE INDEX IDX_6AAB231FF92F3E70 ON animal (country_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231FF92F3E70');
        $this->addSql('DROP INDEX IDX_6AAB231FF92F3E70 ON animal');
        $this->addSql('ALTER TABLE animal ADD country VARCHAR(255) DEFAULT NULL, DROP country_id, CHANGE martial_art martial_art VARCHAR(255) DEFAULT NULL, CHANGE phone_number phone_number VARCHAR(50) NOT NULL');
    }
}
