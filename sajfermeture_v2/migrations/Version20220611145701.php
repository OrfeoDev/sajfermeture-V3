<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220611145701 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE demande_devis ADD type_moteur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE demande_devis ADD CONSTRAINT FK_7DF94602DF32F001 FOREIGN KEY (type_moteur_id) REFERENCES type_moteur (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7DF94602DF32F001 ON demande_devis (type_moteur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE demande_devis DROP FOREIGN KEY FK_7DF94602DF32F001');
        $this->addSql('DROP INDEX UNIQ_7DF94602DF32F001 ON demande_devis');
        $this->addSql('ALTER TABLE demande_devis DROP type_moteur_id');
    }
}
