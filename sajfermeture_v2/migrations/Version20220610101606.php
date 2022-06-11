<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220610101606 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE demande_devis ADD statut_id INT NOT NULL');
        $this->addSql('ALTER TABLE demande_devis ADD CONSTRAINT FK_7DF94602F6203804 FOREIGN KEY (statut_id) REFERENCES demande_statut (id)');
        $this->addSql('CREATE INDEX IDX_7DF94602F6203804 ON demande_devis (statut_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE demande_devis DROP FOREIGN KEY FK_7DF94602F6203804');
        $this->addSql('DROP INDEX IDX_7DF94602F6203804 ON demande_devis');
        $this->addSql('ALTER TABLE demande_devis DROP statut_id');
    }
}
