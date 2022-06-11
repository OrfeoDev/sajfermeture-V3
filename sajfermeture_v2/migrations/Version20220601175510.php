<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220601175510 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE demande_pro (id INT AUTO_INCREMENT NOT NULL, type_depannage_id INT NOT NULL, type_porte_id INT DEFAULT NULL, type_moteur_id INT DEFAULT NULL, info_porte_id INT DEFAULT NULL, professionnel_id INT NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_138CCF6428BAE898 (type_depannage_id), INDEX IDX_138CCF64A633A4DF (type_porte_id), UNIQUE INDEX UNIQ_138CCF64DF32F001 (type_moteur_id), UNIQUE INDEX UNIQ_138CCF647CF9F849 (info_porte_id), INDEX IDX_138CCF648A49CC82 (professionnel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE demande_prospect (id INT AUTO_INCREMENT NOT NULL, prospect_id INT NOT NULL, last_name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_8F97C5BFD182060A (prospect_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, demande_pro_id INT NOT NULL, file_name VARCHAR(255) NOT NULL, INDEX IDX_C53D045F81F3A255 (demande_pro_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE info_porte (id INT AUTO_INCREMENT NOT NULL, hauteur DOUBLE PRECISION DEFAULT NULL, largeur DOUBLE PRECISION DEFAULT NULL, is_ecoin_con TINYINT(1) DEFAULT NULL, is_passage_libre TINYINT(1) DEFAULT NULL, is_retombe TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE professionnel (id INT AUTO_INCREMENT NOT NULL, last_name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, postal_code VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, social_reason VARCHAR(255) NOT NULL, siret VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prospect (id INT AUTO_INCREMENT NOT NULL, last_name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_depannage (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_moteur (id INT AUTO_INCREMENT NOT NULL, numero_moteur VARCHAR(255) DEFAULT NULL, voltage VARCHAR(255) NOT NULL, type_fonctionnement VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_porte (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, professionnel_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D6498A49CC82 (professionnel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_user_role (user_id INT NOT NULL, user_role_id INT NOT NULL, INDEX IDX_2D084B47A76ED395 (user_id), INDEX IDX_2D084B478E0E3CA6 (user_role_id), PRIMARY KEY(user_id, user_role_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_role (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE demande_pro ADD CONSTRAINT FK_138CCF6428BAE898 FOREIGN KEY (type_depannage_id) REFERENCES type_depannage (id)');
        $this->addSql('ALTER TABLE demande_pro ADD CONSTRAINT FK_138CCF64A633A4DF FOREIGN KEY (type_porte_id) REFERENCES type_porte (id)');
        $this->addSql('ALTER TABLE demande_pro ADD CONSTRAINT FK_138CCF64DF32F001 FOREIGN KEY (type_moteur_id) REFERENCES type_moteur (id)');
        $this->addSql('ALTER TABLE demande_pro ADD CONSTRAINT FK_138CCF647CF9F849 FOREIGN KEY (info_porte_id) REFERENCES info_porte (id)');
        $this->addSql('ALTER TABLE demande_pro ADD CONSTRAINT FK_138CCF648A49CC82 FOREIGN KEY (professionnel_id) REFERENCES professionnel (id)');
        $this->addSql('ALTER TABLE demande_prospect ADD CONSTRAINT FK_8F97C5BFD182060A FOREIGN KEY (prospect_id) REFERENCES prospect (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F81F3A255 FOREIGN KEY (demande_pro_id) REFERENCES demande_pro (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6498A49CC82 FOREIGN KEY (professionnel_id) REFERENCES professionnel (id)');
        $this->addSql('ALTER TABLE user_user_role ADD CONSTRAINT FK_2D084B47A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_user_role ADD CONSTRAINT FK_2D084B478E0E3CA6 FOREIGN KEY (user_role_id) REFERENCES user_role (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F81F3A255');
        $this->addSql('ALTER TABLE demande_pro DROP FOREIGN KEY FK_138CCF647CF9F849');
        $this->addSql('ALTER TABLE demande_pro DROP FOREIGN KEY FK_138CCF648A49CC82');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6498A49CC82');
        $this->addSql('ALTER TABLE demande_prospect DROP FOREIGN KEY FK_8F97C5BFD182060A');
        $this->addSql('ALTER TABLE demande_pro DROP FOREIGN KEY FK_138CCF6428BAE898');
        $this->addSql('ALTER TABLE demande_pro DROP FOREIGN KEY FK_138CCF64DF32F001');
        $this->addSql('ALTER TABLE demande_pro DROP FOREIGN KEY FK_138CCF64A633A4DF');
        $this->addSql('ALTER TABLE user_user_role DROP FOREIGN KEY FK_2D084B47A76ED395');
        $this->addSql('ALTER TABLE user_user_role DROP FOREIGN KEY FK_2D084B478E0E3CA6');
        $this->addSql('DROP TABLE demande_pro');
        $this->addSql('DROP TABLE demande_prospect');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE info_porte');
        $this->addSql('DROP TABLE professionnel');
        $this->addSql('DROP TABLE prospect');
        $this->addSql('DROP TABLE type_depannage');
        $this->addSql('DROP TABLE type_moteur');
        $this->addSql('DROP TABLE type_porte');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_user_role');
        $this->addSql('DROP TABLE user_role');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
