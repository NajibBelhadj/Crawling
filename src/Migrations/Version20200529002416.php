<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200529002416 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE provider_provider_hotel');
        $this->addSql('ALTER TABLE provider CHANGE link link VARCHAR(255) DEFAULT NULL, CHANGE tel tel VARCHAR(255) DEFAULT NULL, CHANGE email email VARCHAR(255) DEFAULT NULL, CHANGE adress adress VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE provider_hotel CHANGE ref_id ref_id INT DEFAULT NULL, CHANGE ville_id ville_id INT DEFAULT NULL, CHANGE category category VARCHAR(255) DEFAULT NULL, CHANGE link link VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE provider_hotel_img CHANGE providerhotels_id providerhotels_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE provider_hotel_prix CHANGE providerhotels_id providerhotels_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE provider_provider_hotel (provider_id INT NOT NULL, provider_hotel_id INT NOT NULL, INDEX IDX_2D824057A01D5F1 (provider_hotel_id), INDEX IDX_2D82405A53A8AA (provider_id), PRIMARY KEY(provider_id, provider_hotel_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE provider_provider_hotel ADD CONSTRAINT FK_2D824057A01D5F1 FOREIGN KEY (provider_hotel_id) REFERENCES provider_hotel (id)');
        $this->addSql('ALTER TABLE provider_provider_hotel ADD CONSTRAINT FK_2D82405A53A8AA FOREIGN KEY (provider_id) REFERENCES provider (id)');
        $this->addSql('ALTER TABLE provider CHANGE link link VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE tel tel VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE email email VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE adress adress VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE provider_hotel CHANGE ref_id ref_id INT DEFAULT NULL, CHANGE ville_id ville_id INT DEFAULT NULL, CHANGE category category VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE link link VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE provider_hotel_img CHANGE providerhotels_id providerhotels_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE provider_hotel_prix CHANGE providerhotels_id providerhotels_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
