<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200528210139 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE provider_hotel ADD ville_id INT DEFAULT NULL, CHANGE ref_id ref_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE provider_hotel ADD CONSTRAINT FK_5A05EBADA73F0036 FOREIGN KEY (ville_id) REFERENCES ville (id)');
        $this->addSql('CREATE INDEX IDX_5A05EBADA73F0036 ON provider_hotel (ville_id)');
        $this->addSql('ALTER TABLE provider_hotel_img CHANGE providerhotels_id providerhotels_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE provider_hotel_prix CHANGE providerhotels_id providerhotels_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ref_hotel CHANGE ref_hotel_t_id ref_hotel_t_id INT DEFAULT NULL, CHANGE ref_hotel_tb_id ref_hotel_tb_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE provider_hotel DROP FOREIGN KEY FK_5A05EBADA73F0036');
        $this->addSql('DROP INDEX IDX_5A05EBADA73F0036 ON provider_hotel');
        $this->addSql('ALTER TABLE provider_hotel DROP ville_id, CHANGE ref_id ref_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE provider_hotel_img CHANGE providerhotels_id providerhotels_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE provider_hotel_prix CHANGE providerhotels_id providerhotels_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ref_hotel CHANGE ref_hotel_tb_id ref_hotel_tb_id INT DEFAULT NULL, CHANGE ref_hotel_t_id ref_hotel_t_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
