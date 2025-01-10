<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250110145857 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gallery DROP FOREIGN KEY FK_472B783AA5BC2E0E');
        $this->addSql('DROP INDEX IDX_472B783AA5BC2E0E ON gallery');
        $this->addSql('ALTER TABLE gallery DROP trip_id');
        $this->addSql('ALTER TABLE trip ADD localisation_id INT NOT NULL');
        $this->addSql('ALTER TABLE trip ADD CONSTRAINT FK_7656F53BC68BE09C FOREIGN KEY (localisation_id) REFERENCES localisation (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7656F53BC68BE09C ON trip (localisation_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gallery ADD trip_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE gallery ADD CONSTRAINT FK_472B783AA5BC2E0E FOREIGN KEY (trip_id) REFERENCES trip (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_472B783AA5BC2E0E ON gallery (trip_id)');
        $this->addSql('ALTER TABLE trip DROP FOREIGN KEY FK_7656F53BC68BE09C');
        $this->addSql('DROP INDEX UNIQ_7656F53BC68BE09C ON trip');
        $this->addSql('ALTER TABLE trip DROP localisation_id');
    }
}
