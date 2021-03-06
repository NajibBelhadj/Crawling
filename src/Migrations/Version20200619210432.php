<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200619210432 extends AbstractMigration
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
        $this->addSql('ALTER TABLE provider_hotel CHANGE ville_id ville_id INT DEFAULT NULL, CHANGE provide_id provide_id INT DEFAULT NULL, CHANGE category category VARCHAR(255) DEFAULT NULL, CHANGE link link VARCHAR(255) DEFAULT NULL, CHANGE refe refe INT DEFAULT NULL');
        $this->addSql('ALTER TABLE provider_hotel_img CHANGE providerhotels_id providerhotels_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE provider_hotel_prix DROP FOREIGN KEY FK_659C706E7A01D5F1');
        $this->addSql('DROP INDEX IDX_659C706E7A01D5F1 ON provider_hotel_prix');
        $this->addSql('ALTER TABLE provider_hotel_prix DROP provider_hotel_id, CHANGE providerhotels_id providerhotels_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE provider CHANGE link link VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE tel tel VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE email email VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE adress adress VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE provider_hotel CHANGE ville_id ville_id INT DEFAULT NULL, CHANGE provide_id provide_id INT DEFAULT NULL, CHANGE category category VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE link link VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE refe refe INT DEFAULT NULL');
        $this->addSql('ALTER TABLE provider_hotel_img CHANGE providerhotels_id providerhotels_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE provider_hotel_prix ADD provider_hotel_id INT DEFAULT NULL, CHANGE providerhotels_id providerhotels_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE provider_hotel_prix ADD CONSTRAINT FK_659C706E7A01D5F1 FOREIGN KEY (provider_hotel_id) REFERENCES provider_hotel (id)');
        $this->addSql('CREATE INDEX IDX_659C706E7A01D5F1 ON provider_hotel_prix (provider_hotel_id)');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
