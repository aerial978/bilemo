<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230831172805 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_C82E745E237E06 ON clients');
        $this->addSql('ALTER TABLE clients ADD email VARCHAR(180) NOT NULL, ADD roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', DROP name');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C82E74E7927C74 ON clients (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_C82E74E7927C74 ON clients');
        $this->addSql('ALTER TABLE clients ADD name VARCHAR(50) NOT NULL, DROP email, DROP roles');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C82E745E237E06 ON clients (name)');
    }
}
