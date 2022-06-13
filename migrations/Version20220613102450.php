<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220613102450 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animal ADD owner_id INT NOT NULL');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231F7E3C61F9 FOREIGN KEY (owner_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_6AAB231F7E3C61F9 ON animal (owner_id)');
        $this->addSql('ALTER TABLE checkup ALTER complaints TYPE VARCHAR(1024)');
        $this->addSql('ALTER TABLE checkup ALTER diagnosis TYPE VARCHAR(1024)');
        $this->addSql('ALTER TABLE checkup ALTER treatment TYPE VARCHAR(1024)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE animal DROP CONSTRAINT FK_6AAB231F7E3C61F9');
        $this->addSql('DROP INDEX IDX_6AAB231F7E3C61F9');
        $this->addSql('ALTER TABLE animal DROP owner_id');
        $this->addSql('ALTER TABLE checkup ALTER complaints TYPE VARCHAR(512)');
        $this->addSql('ALTER TABLE checkup ALTER diagnosis TYPE VARCHAR(512)');
        $this->addSql('ALTER TABLE checkup ALTER treatment TYPE VARCHAR(512)');
    }
}
