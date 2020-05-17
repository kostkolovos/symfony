<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200517171500 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE order_storage_calculator ADD price_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE order_storage_calculator ADD CONSTRAINT FK_48837D7AD614C7E7 FOREIGN KEY (price_id) REFERENCES price (id)');
        $this->addSql('CREATE INDEX IDX_48837D7AD614C7E7 ON order_storage_calculator (price_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE order_storage_calculator DROP FOREIGN KEY FK_48837D7AD614C7E7');
        $this->addSql('DROP INDEX IDX_48837D7AD614C7E7 ON order_storage_calculator');
        $this->addSql('ALTER TABLE order_storage_calculator DROP price_id');
    }
}
