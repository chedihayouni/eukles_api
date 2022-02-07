<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220206121600 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client_material (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', client_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', material_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', INDEX IDX_5258455019EB6921 (client_id), INDEX IDX_52584550E308AC6F (material_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE material (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(100) NOT NULL, price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client_material ADD CONSTRAINT FK_5258455019EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE client_material ADD CONSTRAINT FK_52584550E308AC6F FOREIGN KEY (material_id) REFERENCES material (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client_material DROP FOREIGN KEY FK_5258455019EB6921');
        $this->addSql('ALTER TABLE client_material DROP FOREIGN KEY FK_52584550E308AC6F');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE client_material');
        $this->addSql('DROP TABLE material');
    }
}
