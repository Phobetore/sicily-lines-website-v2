<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230323104453 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE periode CHANGE date_debut date_debut TIME NOT NULL, CHANGE date_fin date_fin TIME NOT NULL');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955C54C8C93');
        $this->addSql('DROP INDEX IDX_42C84955C54C8C93 ON reservation');
        $this->addSql('ALTER TABLE reservation DROP type_id');
        $this->addSql('ALTER TABLE reservation_type ADD type_id INT DEFAULT NULL, ADD reservation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation_type ADD CONSTRAINT FK_9AE79A41C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE reservation_type ADD CONSTRAINT FK_9AE79A41B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id)');
        $this->addSql('CREATE INDEX IDX_9AE79A41C54C8C93 ON reservation_type (type_id)');
        $this->addSql('CREATE INDEX IDX_9AE79A41B83297E7 ON reservation_type (reservation_id)');
        $this->addSql('ALTER TABLE traversee CHANGE date date DATE NOT NULL, CHANGE heure heure TIME NOT NULL');
        $this->addSql('ALTER TABLE type DROP FOREIGN KEY FK_8CDE5729B83297E7');
        $this->addSql('DROP INDEX IDX_8CDE5729B83297E7 ON type');
        $this->addSql('ALTER TABLE type DROP reservation_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE periode CHANGE date_debut date_debut VARCHAR(100) NOT NULL, CHANGE date_fin date_fin VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE reservation ADD type_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955C54C8C93 FOREIGN KEY (type_id) REFERENCES reservation_type (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_42C84955C54C8C93 ON reservation (type_id)');
        $this->addSql('ALTER TABLE reservation_type DROP FOREIGN KEY FK_9AE79A41C54C8C93');
        $this->addSql('ALTER TABLE reservation_type DROP FOREIGN KEY FK_9AE79A41B83297E7');
        $this->addSql('DROP INDEX IDX_9AE79A41C54C8C93 ON reservation_type');
        $this->addSql('DROP INDEX IDX_9AE79A41B83297E7 ON reservation_type');
        $this->addSql('ALTER TABLE reservation_type DROP type_id, DROP reservation_id');
        $this->addSql('ALTER TABLE traversee CHANGE date date VARCHAR(100) NOT NULL, CHANGE heure heure VARCHAR(8) NOT NULL');
        $this->addSql('ALTER TABLE type ADD reservation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE type ADD CONSTRAINT FK_8CDE5729B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation_type (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_8CDE5729B83297E7 ON type (reservation_id)');
    }
}
