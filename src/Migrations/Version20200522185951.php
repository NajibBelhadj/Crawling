<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200522185951 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE provider ADD tel VARCHAR(255) NOT NULL, ADD email VARCHAR(255) NOT NULL, ADD adress VARCHAR(255) NOT NULL, CHANGE description description LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE provider_provider_hotel DROP FOREIGN KEY FK_2D824057A01D5F1');
        $this->addSql('ALTER TABLE provider_provider_hotel DROP FOREIGN KEY FK_2D82405A53A8AA');
        $this->addSql('ALTER TABLE provider_provider_hotel ADD CONSTRAINT FK_2D824057A01D5F1 FOREIGN KEY (provider_hotel_id) REFERENCES provider_hotel (id)');
        $this->addSql('ALTER TABLE provider_provider_hotel ADD CONSTRAINT FK_2D82405A53A8AA FOREIGN KEY (provider_id) REFERENCES provider (id)');
        $this->addSql('ALTER TABLE provider_hotel DROP ville');
        $this->addSql('ALTER TABLE provider_hotel_img CHANGE providerhotels_id providerhotels_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE provider_hotel_prix ADD date VARCHAR(255) NOT NULL, CHANGE providerhotels_id providerhotels_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ref_hotel CHANGE ref_hotel_t_id ref_hotel_t_id INT DEFAULT NULL, CHANGE ref_hotel_tb_id ref_hotel_tb_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE provider DROP tel, DROP email, DROP adress, CHANGE description description VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE provider_hotel ADD ville VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE provider_hotel_img CHANGE providerhotels_id providerhotels_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE provider_hotel_prix DROP date, CHANGE providerhotels_id providerhotels_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE provider_provider_hotel DROP FOREIGN KEY FK_2D82405A53A8AA');
        $this->addSql('ALTER TABLE provider_provider_hotel DROP FOREIGN KEY FK_2D824057A01D5F1');
        $this->addSql('ALTER TABLE provider_provider_hotel ADD CONSTRAINT FK_2D82405A53A8AA FOREIGN KEY (provider_id) REFERENCES provider (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE provider_provider_hotel ADD CONSTRAINT FK_2D824057A01D5F1 FOREIGN KEY (provider_hotel_id) REFERENCES provider_hotel (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ref_hotel CHANGE ref_hotel_tb_id ref_hotel_tb_id INT DEFAULT NULL, CHANGE ref_hotel_t_id ref_hotel_t_id INT DEFAULT NULL');
    }
}
