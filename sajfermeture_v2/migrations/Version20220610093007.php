<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220610093007 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE demande_devis (id INT AUTO_INCREMENT NOT NULL, professionnel_id INT NOT NULL, info_porte_id INT NOT NULL, type_porte_id INT NOT NULL, INDEX IDX_7DF946028A49CC82 (professionnel_id), UNIQUE INDEX UNIQ_7DF946027CF9F849 (info_porte_id), INDEX IDX_7DF94602A633A4DF (type_porte_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE demande_devis ADD CONSTRAINT FK_7DF946028A49CC82 FOREIGN KEY (professionnel_id) REFERENCES professionnel (id)');
        $this->addSql('ALTER TABLE demande_devis ADD CONSTRAINT FK_7DF946027CF9F849 FOREIGN KEY (info_porte_id) REFERENCES info_porte (id)');
        $this->addSql('ALTER TABLE demande_devis ADD CONSTRAINT FK_7DF94602A633A4DF FOREIGN KEY (type_porte_id) REFERENCES type_porte (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE demande_devis');
    }
}
