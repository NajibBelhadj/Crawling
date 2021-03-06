<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200529023709 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE provider_hotel_provider_hotel (provider_hotel_source INT NOT NULL, provider_hotel_target INT NOT NULL, INDEX IDX_37C550539016A1A9 (provider_hotel_source), INDEX IDX_37C5505389F3F126 (provider_hotel_target), PRIMARY KEY(provider_hotel_source, provider_hotel_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE provider_hotel_provider_hotel ADD CONSTRAINT FK_37C550539016A1A9 FOREIGN KEY (provider_hotel_source) REFERENCES provider_hotel (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE provider_hotel_provider_hotel ADD CONSTRAINT FK_37C5505389F3F126 FOREIGN KEY (provider_hotel_target) REFERENCES provider_hotel (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE provider CHANGE link link VARCHAR(255) DEFAULT NULL, CHANGE tel tel VARCHAR(255) DEFAULT NULL, CHANGE email email VARCHAR(255) DEFAULT NULL, CHANGE adress adress VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE provider_hotel DROP FOREIGN KEY FK_5A05EBAD21B741A9');
        $this->addSql('DROP INDEX UNIQ_5A05EBAD21B741A9 ON provider_hotel');
        $this->addSql('ALTER TABLE provider_hotel DROP ref_id, CHANGE ville_id ville_id INT DEFAULT NULL, CHANGE provide_id provide_id INT DEFAULT NULL, CHANGE category category VARCHAR(255) DEFAULT NULL, CHANGE link link VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE provider_hotel_img CHANGE providerhotels_id providerhotels_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE provider_hotel_prix CHANGE providerhotels_id providerhotels_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE provider_hotel_provider_hotel');
        $this->addSql('ALTER TABLE provider CHANGE link link VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE tel tel VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE email email VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE adress adress VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE provider_hotel ADD ref_id INT DEFAULT NULL, CHANGE ville_id ville_id INT DEFAULT NULL, CHANGE provide_id provide_id INT DEFAULT NULL, CHANGE category category VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE link link VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE provider_hotel ADD CONSTRAINT FK_5A05EBAD21B741A9 FOREIGN KEY (ref_id) REFERENCES provider_hotel (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5A05EBAD21B741A9 ON provider_hotel (ref_id)');
        $this->addSql('ALTER TABLE provider_hotel_img CHANGE providerhotels_id providerhotels_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE provider_hotel_prix CHANGE providerhotels_id providerhotels_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
