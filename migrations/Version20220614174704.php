<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220614174704 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE classe CHANGE libelle libelle VARCHAR(20) NOT NULL, CHANGE filiere filiere VARCHAR(20) NOT NULL, CHANGE niveau niveau VARCHAR(20) NOT NULL');
        $this->addSql('ALTER TABLE demande ADD motif VARCHAR(50) DEFAULT NULL, ADD etat VARCHAR(25) DEFAULT NULL, CHANGE r_p_id r_p_id INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE classe CHANGE libelle libelle VARCHAR(20) DEFAULT NULL, CHANGE filiere filiere VARCHAR(20) DEFAULT NULL, CHANGE niveau niveau VARCHAR(20) DEFAULT NULL');
        $this->addSql('ALTER TABLE demande DROP motif, DROP etat, CHANGE r_p_id r_p_id INT DEFAULT NULL');
    }
}
