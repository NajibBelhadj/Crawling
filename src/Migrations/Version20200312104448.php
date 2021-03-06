<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200312104448 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE provider_provider_hotel DROP FOREIGN KEY FK_2D824057A01D5F1');
        $this->addSql('ALTER TABLE provider_provider_hotel DROP FOREIGN KEY FK_2D82405A53A8AA');
        $this->addSql('ALTER TABLE provider_provider_hotel ADD CONSTRAINT FK_2D824057A01D5F1 FOREIGN KEY (provider_hotel_id) REFERENCES provider_hotel (id)');
        $this->addSql('ALTER TABLE provider_provider_hotel ADD CONSTRAINT FK_2D82405A53A8AA FOREIGN KEY (provider_id) REFERENCES provider (id)');
        $this->addSql('ALTER TABLE provider_hotel_img CHANGE providerhotels_id providerhotels_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE provider_hotel_prix CHANGE providerhotels_id providerhotels_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ref_hotel CHANGE ref_hotel_t_id ref_hotel_t_id INT DEFAULT NULL, CHANGE ref_hotel_tb_id ref_hotel_tb_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE provider_hotel_img CHANGE providerhotels_id providerhotels_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE provider_hotel_prix CHANGE providerhotels_id providerhotels_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE provider_provider_hotel DROP FOREIGN KEY FK_2D82405A53A8AA');
        $this->addSql('ALTER TABLE provider_provider_hotel DROP FOREIGN KEY FK_2D824057A01D5F1');
        $this->addSql('ALTER TABLE provider_provider_hotel ADD CONSTRAINT FK_2D82405A53A8AA FOREIGN KEY (provider_id) REFERENCES provider (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE provider_provider_hotel ADD CONSTRAINT FK_2D824057A01D5F1 FOREIGN KEY (provider_hotel_id) REFERENCES provider_hotel (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ref_hotel CHANGE ref_hotel_tb_id ref_hotel_tb_id INT DEFAULT NULL, CHANGE ref_hotel_t_id ref_hotel_t_id INT DEFAULT NULL');
    }
}
