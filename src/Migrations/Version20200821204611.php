<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200821204611 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE storage_media_object (storage_id INT NOT NULL, media_object_id INT NOT NULL, INDEX IDX_58B7B1955CC5DB90 (storage_id), INDEX IDX_58B7B19564DE5A5 (media_object_id), PRIMARY KEY(storage_id, media_object_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE storage_media_object ADD CONSTRAINT FK_58B7B1955CC5DB90 FOREIGN KEY (storage_id) REFERENCES storage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE storage_media_object ADD CONSTRAINT FK_58B7B19564DE5A5 FOREIGN KEY (media_object_id) REFERENCES media_object (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE storage DROP FOREIGN KEY FK_547A1B343DA5256D');
        $this->addSql('DROP INDEX IDX_547A1B343DA5256D ON storage');
        $this->addSql('ALTER TABLE storage DROP image_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE storage_media_object');
        $this->addSql('ALTER TABLE storage ADD image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE storage ADD CONSTRAINT FK_547A1B343DA5256D FOREIGN KEY (image_id) REFERENCES media_object (id)');
        $this->addSql('CREATE INDEX IDX_547A1B343DA5256D ON storage (image_id)');
    }
}
