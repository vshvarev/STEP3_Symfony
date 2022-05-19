<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220519062732 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(255) NOT NULL, phone_number VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE film (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(255) NOT NULL, duration INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE movie_session (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', film_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', date_time_start DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', maximum_count_of_tickets INT NOT NULL, INDEX IDX_F0D297FA567F5183 (film_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ticket (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', client_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', movie_session_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', INDEX IDX_97A0ADA319EB6921 (client_id), INDEX IDX_97A0ADA388CF9CE3 (movie_session_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE movie_session ADD CONSTRAINT FK_F0D297FA567F5183 FOREIGN KEY (film_id) REFERENCES film (id)');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA319EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA388CF9CE3 FOREIGN KEY (movie_session_id) REFERENCES movie_session (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA319EB6921');
        $this->addSql('ALTER TABLE movie_session DROP FOREIGN KEY FK_F0D297FA567F5183');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA388CF9CE3');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE film');
        $this->addSql('DROP TABLE movie_session');
        $this->addSql('DROP TABLE ticket');
    }
}
