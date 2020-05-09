<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200509130757 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE concert_participant ADD id INT AUTO_INCREMENT NOT NULL, CHANGE user_id user_id INT DEFAULT NULL, CHANGE concert_id concert_id INT DEFAULT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE concert_participant ADD CONSTRAINT FK_D32CAA3DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE concert_participant ADD CONSTRAINT FK_D32CAA3D83C97B2E FOREIGN KEY (concert_id) REFERENCES concert (id)');
        $this->addSql('CREATE INDEX IDX_D32CAA3DA76ED395 ON concert_participant (user_id)');
        $this->addSql('CREATE INDEX IDX_D32CAA3D83C97B2E ON concert_participant (concert_id)');
        $this->addSql('CREATE UNIQUE INDEX user_concert_unique ON concert_participant (user_id, concert_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE concert_participant MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE concert_participant DROP FOREIGN KEY FK_D32CAA3DA76ED395');
        $this->addSql('ALTER TABLE concert_participant DROP FOREIGN KEY FK_D32CAA3D83C97B2E');
        $this->addSql('DROP INDEX IDX_D32CAA3DA76ED395 ON concert_participant');
        $this->addSql('DROP INDEX IDX_D32CAA3D83C97B2E ON concert_participant');
        $this->addSql('DROP INDEX user_concert_unique ON concert_participant');
        $this->addSql('ALTER TABLE concert_participant DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE concert_participant DROP id, CHANGE user_id user_id INT NOT NULL, CHANGE concert_id concert_id INT NOT NULL');
        $this->addSql('ALTER TABLE concert_participant ADD PRIMARY KEY (user_id, concert_id)');
    }
}
