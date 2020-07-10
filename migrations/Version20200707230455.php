<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200707230455 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chambre ADD batiment_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE chambre ADD CONSTRAINT FK_C509E4FFD6F6891B FOREIGN KEY (batiment_id) REFERENCES batiment (id)');
        $this->addSql('CREATE INDEX IDX_C509E4FFD6F6891B ON chambre (batiment_id)');
        $this->addSql('ALTER TABLE etudiants ADD relation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE etudiants ADD CONSTRAINT FK_227C02EB3256915B FOREIGN KEY (relation_id) REFERENCES chambre (id)');
        $this->addSql('CREATE INDEX IDX_227C02EB3256915B ON etudiants (relation_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chambre DROP FOREIGN KEY FK_C509E4FFD6F6891B');
        $this->addSql('DROP INDEX IDX_C509E4FFD6F6891B ON chambre');
        $this->addSql('ALTER TABLE chambre DROP batiment_id');
        $this->addSql('ALTER TABLE etudiants DROP FOREIGN KEY FK_227C02EB3256915B');
        $this->addSql('DROP INDEX IDX_227C02EB3256915B ON etudiants');
        $this->addSql('ALTER TABLE etudiants DROP relation_id');
    }
}
