<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200513203733 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE order_storage_calculator_storage_pet_type (order_storage_calculator_id INT NOT NULL, storage_pet_type_id INT NOT NULL, INDEX IDX_303268DFD107FDDF (order_storage_calculator_id), INDEX IDX_303268DFD192F554 (storage_pet_type_id), PRIMARY KEY(order_storage_calculator_id, storage_pet_type_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE order_storage_calculator_storage_pet_type ADD CONSTRAINT FK_303268DFD107FDDF FOREIGN KEY (order_storage_calculator_id) REFERENCES order_storage_calculator (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE order_storage_calculator_storage_pet_type ADD CONSTRAINT FK_303268DFD192F554 FOREIGN KEY (storage_pet_type_id) REFERENCES storage_pet_type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE storage_pet_type CHANGE microchip microchip VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE order_storage_calculator_storage_pet_type');
        $this->addSql('ALTER TABLE storage_pet_type CHANGE microchip microchip VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
