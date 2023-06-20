<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230620064445 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE products ADD conditions_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5AC5FBDC0F FOREIGN KEY (conditions_id) REFERENCES conditions (id)');
        $this->addSql('CREATE INDEX IDX_B3BA5A5AC5FBDC0F ON products (conditions_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5AC5FBDC0F');
        $this->addSql('DROP INDEX IDX_B3BA5A5AC5FBDC0F ON products');
        $this->addSql('ALTER TABLE products DROP conditions_id');
    }
}