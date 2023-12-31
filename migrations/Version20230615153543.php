<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230615153543 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }


    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE products CHANGE screen_size screen_size VARCHAR(50) NOT NULL');
    }


    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE products CHANGE screen_size screen_size VARCHAR(25) NOT NULL');
    }
}
