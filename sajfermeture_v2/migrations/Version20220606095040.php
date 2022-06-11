<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220606095040 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE demande_pro ADD demande_statut_id INT NOT NULL');
        $this->addSql('ALTER TABLE demande_pro ADD CONSTRAINT FK_138CCF64830CC2D1 FOREIGN KEY (demande_statut_id) REFERENCES demande_statut (id)');
        $this->addSql('CREATE INDEX IDX_138CCF64830CC2D1 ON demande_pro (demande_statut_id)');
        $this->addSql('ALTER TABLE demande_prospect ADD demande_statut_id INT NOT NULL');
        $this->addSql('ALTER TABLE demande_prospect ADD CONSTRAINT FK_8F97C5BF830CC2D1 FOREIGN KEY (demande_statut_id) REFERENCES demande_statut (id)');
        $this->addSql('CREATE INDEX IDX_8F97C5BF830CC2D1 ON demande_prospect (demande_statut_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE demande_pro DROP FOREIGN KEY FK_138CCF64830CC2D1');
        $this->addSql('DROP INDEX IDX_138CCF64830CC2D1 ON demande_pro');
        $this->addSql('ALTER TABLE demande_pro DROP demande_statut_id');
        $this->addSql('ALTER TABLE demande_prospect DROP FOREIGN KEY FK_8F97C5BF830CC2D1');
        $this->addSql('DROP INDEX IDX_8F97C5BF830CC2D1 ON demande_prospect');
        $this->addSql('ALTER TABLE demande_prospect DROP demande_statut_id');
    }
}
