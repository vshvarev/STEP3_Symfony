<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220517074449 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE movie_session (id INT AUTO_INCREMENT NOT NULL, film_id INT NOT NULL, date_time_start DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', maximum_count_of_tickets INT NOT NULL, INDEX IDX_F0D297FA567F5183 (film_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE movie_session ADD CONSTRAINT FK_F0D297FA567F5183 FOREIGN KEY (film_id) REFERENCES film (id)');
        $this->addSql('ALTER TABLE ticket ADD movie_session_id INT NOT NULL');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA388CF9CE3 FOREIGN KEY (movie_session_id) REFERENCES movie_session (id)');
        $this->addSql('CREATE INDEX IDX_97A0ADA388CF9CE3 ON ticket (movie_session_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA388CF9CE3');
        $this->addSql('DROP TABLE movie_session');
        $this->addSql('DROP INDEX IDX_97A0ADA388CF9CE3 ON ticket');
        $this->addSql('ALTER TABLE ticket DROP movie_session_id');
    }
}
