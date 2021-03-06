<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200529004035 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE provider CHANGE link link VARCHAR(255) DEFAULT NULL, CHANGE tel tel VARCHAR(255) DEFAULT NULL, CHANGE email email VARCHAR(255) DEFAULT NULL, CHANGE adress adress VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE provider_hotel ADD provide_id INT DEFAULT NULL, CHANGE ref_id ref_id INT DEFAULT NULL, CHANGE ville_id ville_id INT DEFAULT NULL, CHANGE category category VARCHAR(255) DEFAULT NULL, CHANGE link link VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE provider_hotel ADD CONSTRAINT FK_5A05EBAD9B54C5B7 FOREIGN KEY (provide_id) REFERENCES provider (id)');
        $this->addSql('CREATE INDEX IDX_5A05EBAD9B54C5B7 ON provider_hotel (provide_id)');
        $this->addSql('ALTER TABLE provider_hotel_img CHANGE providerhotels_id providerhotels_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE provider_hotel_prix CHANGE providerhotels_id providerhotels_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE provider CHANGE link link VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE tel tel VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE email email VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE adress adress VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE provider_hotel DROP FOREIGN KEY FK_5A05EBAD9B54C5B7');
        $this->addSql('DROP INDEX IDX_5A05EBAD9B54C5B7 ON provider_hotel');
        $this->addSql('ALTER TABLE provider_hotel DROP provide_id, CHANGE ref_id ref_id INT DEFAULT NULL, CHANGE ville_id ville_id INT DEFAULT NULL, CHANGE category category VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE link link VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE provider_hotel_img CHANGE providerhotels_id providerhotels_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE provider_hotel_prix CHANGE providerhotels_id providerhotels_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
