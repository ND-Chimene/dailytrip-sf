<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250110150558 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE poi ADD localisation_id INT NOT NULL');
        $this->addSql('ALTER TABLE poi ADD CONSTRAINT FK_7DBB1FD6C68BE09C FOREIGN KEY (localisation_id) REFERENCES localisation (id)');
        $this->addSql('CREATE INDEX IDX_7DBB1FD6C68BE09C ON poi (localisation_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE poi DROP FOREIGN KEY FK_7DBB1FD6C68BE09C');
        $this->addSql('DROP INDEX IDX_7DBB1FD6C68BE09C ON poi');
        $this->addSql('ALTER TABLE poi DROP localisation_id');
    }
}
