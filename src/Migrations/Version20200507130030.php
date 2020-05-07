<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200507130030 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE storage ADD storage_types_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE storage ADD CONSTRAINT FK_547A1B342D790F10 FOREIGN KEY (storage_types_id) REFERENCES storage_types (id)');
        $this->addSql('CREATE INDEX IDX_547A1B342D790F10 ON storage (storage_types_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE storage DROP FOREIGN KEY FK_547A1B342D790F10');
        $this->addSql('DROP INDEX IDX_547A1B342D790F10 ON storage');
        $this->addSql('ALTER TABLE storage DROP storage_types_id');
    }
}
