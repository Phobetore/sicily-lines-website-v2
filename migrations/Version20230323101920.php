<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230323101920 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bateau (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, longueur INT NOT NULL, largeur INT NOT NULL, vitesse VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bateau_categorie (id INT AUTO_INCREMENT NOT NULL, bateau_id INT DEFAULT NULL, categorie_id INT DEFAULT NULL, nb_max INT NOT NULL, INDEX IDX_9269E920A9706509 (bateau_id), INDEX IDX_9269E920BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, adresse VARCHAR(255) NOT NULL, cp VARCHAR(6) NOT NULL, ville VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipement (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipement_bateau (id INT AUTO_INCREMENT NOT NULL, bateau_id INT NOT NULL, equipement_id INT NOT NULL, quantite INT NOT NULL, INDEX IDX_F0F14295A9706509 (bateau_id), INDEX IDX_F0F14295806F0F5C (equipement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE liaison (id INT AUTO_INCREMENT NOT NULL, secteur_id INT NOT NULL, port_depart_id INT DEFAULT NULL, port_arrivee_id INT DEFAULT NULL, duree VARCHAR(7) NOT NULL, INDEX IDX_225AC379F7E4405 (secteur_id), INDEX IDX_225AC3794C9CCD3 (port_depart_id), INDEX IDX_225AC37141EAE06 (port_arrivee_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE liaison_periode_type (id INT AUTO_INCREMENT NOT NULL, periode_id INT DEFAULT NULL, type_id INT DEFAULT NULL, liaison_id INT DEFAULT NULL, tarif VARCHAR(10) NOT NULL, INDEX IDX_EB210873F384C1CF (periode_id), INDEX IDX_EB210873C54C8C93 (type_id), INDEX IDX_EB210873ED31185 (liaison_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE periode (id INT AUTO_INCREMENT NOT NULL, date_debut VARCHAR(100) NOT NULL, date_fin VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE port (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, traversee_id INT DEFAULT NULL, type_id INT DEFAULT NULL, INDEX IDX_42C8495519EB6921 (client_id), INDEX IDX_42C84955ED2BB15B (traversee_id), INDEX IDX_42C84955C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation_type (id INT AUTO_INCREMENT NOT NULL, nombre INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE secteur (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE traversee (id INT AUTO_INCREMENT NOT NULL, liaison_id INT DEFAULT NULL, bateau_id INT DEFAULT NULL, date VARCHAR(100) NOT NULL, heure VARCHAR(8) NOT NULL, INDEX IDX_B688F501ED31185 (liaison_id), INDEX IDX_B688F501A9706509 (bateau_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, reservation_id INT DEFAULT NULL, categorie_id INT NOT NULL, libelle VARCHAR(100) NOT NULL, INDEX IDX_8CDE5729B83297E7 (reservation_id), INDEX IDX_8CDE5729BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bateau_categorie ADD CONSTRAINT FK_9269E920A9706509 FOREIGN KEY (bateau_id) REFERENCES bateau (id)');
        $this->addSql('ALTER TABLE bateau_categorie ADD CONSTRAINT FK_9269E920BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE equipement_bateau ADD CONSTRAINT FK_F0F14295A9706509 FOREIGN KEY (bateau_id) REFERENCES bateau (id)');
        $this->addSql('ALTER TABLE equipement_bateau ADD CONSTRAINT FK_F0F14295806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipement (id)');
        $this->addSql('ALTER TABLE liaison ADD CONSTRAINT FK_225AC379F7E4405 FOREIGN KEY (secteur_id) REFERENCES secteur (id)');
        $this->addSql('ALTER TABLE liaison ADD CONSTRAINT FK_225AC3794C9CCD3 FOREIGN KEY (port_depart_id) REFERENCES port (id)');
        $this->addSql('ALTER TABLE liaison ADD CONSTRAINT FK_225AC37141EAE06 FOREIGN KEY (port_arrivee_id) REFERENCES port (id)');
        $this->addSql('ALTER TABLE liaison_periode_type ADD CONSTRAINT FK_EB210873F384C1CF FOREIGN KEY (periode_id) REFERENCES periode (id)');
        $this->addSql('ALTER TABLE liaison_periode_type ADD CONSTRAINT FK_EB210873C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE liaison_periode_type ADD CONSTRAINT FK_EB210873ED31185 FOREIGN KEY (liaison_id) REFERENCES liaison (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495519EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955ED2BB15B FOREIGN KEY (traversee_id) REFERENCES traversee (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955C54C8C93 FOREIGN KEY (type_id) REFERENCES reservation_type (id)');
        $this->addSql('ALTER TABLE traversee ADD CONSTRAINT FK_B688F501ED31185 FOREIGN KEY (liaison_id) REFERENCES liaison (id)');
        $this->addSql('ALTER TABLE traversee ADD CONSTRAINT FK_B688F501A9706509 FOREIGN KEY (bateau_id) REFERENCES bateau (id)');
        $this->addSql('ALTER TABLE type ADD CONSTRAINT FK_8CDE5729B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation_type (id)');
        $this->addSql('ALTER TABLE type ADD CONSTRAINT FK_8CDE5729BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bateau_categorie DROP FOREIGN KEY FK_9269E920A9706509');
        $this->addSql('ALTER TABLE bateau_categorie DROP FOREIGN KEY FK_9269E920BCF5E72D');
        $this->addSql('ALTER TABLE equipement_bateau DROP FOREIGN KEY FK_F0F14295A9706509');
        $this->addSql('ALTER TABLE equipement_bateau DROP FOREIGN KEY FK_F0F14295806F0F5C');
        $this->addSql('ALTER TABLE liaison DROP FOREIGN KEY FK_225AC379F7E4405');
        $this->addSql('ALTER TABLE liaison DROP FOREIGN KEY FK_225AC3794C9CCD3');
        $this->addSql('ALTER TABLE liaison DROP FOREIGN KEY FK_225AC37141EAE06');
        $this->addSql('ALTER TABLE liaison_periode_type DROP FOREIGN KEY FK_EB210873F384C1CF');
        $this->addSql('ALTER TABLE liaison_periode_type DROP FOREIGN KEY FK_EB210873C54C8C93');
        $this->addSql('ALTER TABLE liaison_periode_type DROP FOREIGN KEY FK_EB210873ED31185');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C8495519EB6921');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955ED2BB15B');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955C54C8C93');
        $this->addSql('ALTER TABLE traversee DROP FOREIGN KEY FK_B688F501ED31185');
        $this->addSql('ALTER TABLE traversee DROP FOREIGN KEY FK_B688F501A9706509');
        $this->addSql('ALTER TABLE type DROP FOREIGN KEY FK_8CDE5729B83297E7');
        $this->addSql('ALTER TABLE type DROP FOREIGN KEY FK_8CDE5729BCF5E72D');
        $this->addSql('DROP TABLE bateau');
        $this->addSql('DROP TABLE bateau_categorie');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE equipement');
        $this->addSql('DROP TABLE equipement_bateau');
        $this->addSql('DROP TABLE liaison');
        $this->addSql('DROP TABLE liaison_periode_type');
        $this->addSql('DROP TABLE periode');
        $this->addSql('DROP TABLE port');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE reservation_type');
        $this->addSql('DROP TABLE secteur');
        $this->addSql('DROP TABLE traversee');
        $this->addSql('DROP TABLE type');
    }
}
