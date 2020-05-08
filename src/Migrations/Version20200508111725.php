<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200508111725 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE storage_pet_type (id INT AUTO_INCREMENT NOT NULL, microchip TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE storage_pet_type_storage (storage_pet_type_id INT NOT NULL, storage_id INT NOT NULL, INDEX IDX_98E06073D192F554 (storage_pet_type_id), INDEX IDX_98E060735CC5DB90 (storage_id), PRIMARY KEY(storage_pet_type_id, storage_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE storage_pet_type_storage ADD CONSTRAINT FK_98E06073D192F554 FOREIGN KEY (storage_pet_type_id) REFERENCES storage_pet_type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE storage_pet_type_storage ADD CONSTRAINT FK_98E060735CC5DB90 FOREIGN KEY (storage_id) REFERENCES storage (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE storage_pet_type_storage DROP FOREIGN KEY FK_98E06073D192F554');
        $this->addSql('DROP TABLE storage_pet_type');
        $this->addSql('DROP TABLE storage_pet_type_storage');
    }
}
