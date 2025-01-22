<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250121155750 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(80) NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gallery (id INT AUTO_INCREMENT NOT NULL, trip_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_472B783AA5BC2E0E (trip_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gallery_image (gallery_id INT NOT NULL, image_id INT NOT NULL, INDEX IDX_21A0D47C4E7AF8F (gallery_id), INDEX IDX_21A0D47C3DA5256D (image_id), PRIMARY KEY(gallery_id, image_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, url VARCHAR(255) NOT NULL, INDEX IDX_C53D045FA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE localisation (id INT AUTO_INCREMENT NOT NULL, start VARCHAR(255) NOT NULL, finish VARCHAR(255) NOT NULL, distance NUMERIC(8, 2) NOT NULL, duration VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE poi (id INT AUTO_INCREMENT NOT NULL, location_id INT NOT NULL, gallery_id INT DEFAULT NULL, point VARCHAR(255) NOT NULL, INDEX IDX_7DBB1FD664D218E (location_id), UNIQUE INDEX UNIQ_7DBB1FD64E7AF8F (gallery_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rating (id INT AUTO_INCREMENT NOT NULL, trip_id INT NOT NULL, evaluator_id INT NOT NULL, note INT NOT NULL, ip_address VARCHAR(50) NOT NULL, INDEX IDX_D8892622A5BC2E0E (trip_id), INDEX IDX_D889262243575BE2 (evaluator_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE review (id INT AUTO_INCREMENT NOT NULL, trip_id INT NOT NULL, reviewer_id INT NOT NULL, fullname VARCHAR(120) NOT NULL, content LONGTEXT NOT NULL, email VARCHAR(80) NOT NULL, INDEX IDX_794381C6A5BC2E0E (trip_id), INDEX IDX_794381C670574616 (reviewer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trip (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, localisation_id INT NOT NULL, author_id INT NOT NULL, ref VARCHAR(255) NOT NULL, title VARCHAR(80) NOT NULL, description LONGTEXT DEFAULT NULL, cover VARCHAR(255) NOT NULL, email VARCHAR(80) NOT NULL, status TINYINT(1) NOT NULL, INDEX IDX_7656F53B12469DE2 (category_id), UNIQUE INDEX UNIQ_7656F53BC68BE09C (localisation_id), INDEX IDX_7656F53BF675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, username VARCHAR(80) DEFAULT NULL, is_verified TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE gallery ADD CONSTRAINT FK_472B783AA5BC2E0E FOREIGN KEY (trip_id) REFERENCES trip (id)');
        $this->addSql('ALTER TABLE gallery_image ADD CONSTRAINT FK_21A0D47C4E7AF8F FOREIGN KEY (gallery_id) REFERENCES gallery (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gallery_image ADD CONSTRAINT FK_21A0D47C3DA5256D FOREIGN KEY (image_id) REFERENCES image (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE poi ADD CONSTRAINT FK_7DBB1FD664D218E FOREIGN KEY (location_id) REFERENCES localisation (id)');
        $this->addSql('ALTER TABLE poi ADD CONSTRAINT FK_7DBB1FD64E7AF8F FOREIGN KEY (gallery_id) REFERENCES gallery (id)');
        $this->addSql('ALTER TABLE rating ADD CONSTRAINT FK_D8892622A5BC2E0E FOREIGN KEY (trip_id) REFERENCES trip (id)');
        $this->addSql('ALTER TABLE rating ADD CONSTRAINT FK_D889262243575BE2 FOREIGN KEY (evaluator_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C6A5BC2E0E FOREIGN KEY (trip_id) REFERENCES trip (id)');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C670574616 FOREIGN KEY (reviewer_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE trip ADD CONSTRAINT FK_7656F53B12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE trip ADD CONSTRAINT FK_7656F53BC68BE09C FOREIGN KEY (localisation_id) REFERENCES localisation (id)');
        $this->addSql('ALTER TABLE trip ADD CONSTRAINT FK_7656F53BF675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gallery DROP FOREIGN KEY FK_472B783AA5BC2E0E');
        $this->addSql('ALTER TABLE gallery_image DROP FOREIGN KEY FK_21A0D47C4E7AF8F');
        $this->addSql('ALTER TABLE gallery_image DROP FOREIGN KEY FK_21A0D47C3DA5256D');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045FA76ED395');
        $this->addSql('ALTER TABLE poi DROP FOREIGN KEY FK_7DBB1FD664D218E');
        $this->addSql('ALTER TABLE poi DROP FOREIGN KEY FK_7DBB1FD64E7AF8F');
        $this->addSql('ALTER TABLE rating DROP FOREIGN KEY FK_D8892622A5BC2E0E');
        $this->addSql('ALTER TABLE rating DROP FOREIGN KEY FK_D889262243575BE2');
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C6A5BC2E0E');
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C670574616');
        $this->addSql('ALTER TABLE trip DROP FOREIGN KEY FK_7656F53B12469DE2');
        $this->addSql('ALTER TABLE trip DROP FOREIGN KEY FK_7656F53BC68BE09C');
        $this->addSql('ALTER TABLE trip DROP FOREIGN KEY FK_7656F53BF675F31B');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE gallery');
        $this->addSql('DROP TABLE gallery_image');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE localisation');
        $this->addSql('DROP TABLE poi');
        $this->addSql('DROP TABLE rating');
        $this->addSql('DROP TABLE review');
        $this->addSql('DROP TABLE trip');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
