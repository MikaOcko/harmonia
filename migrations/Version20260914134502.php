<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260914134502 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE track_playlist (track_id INT NOT NULL, playlist_id INT NOT NULL, INDEX IDX_B45DE36C5ED23C43 (track_id), INDEX IDX_B45DE36C6BBD148 (playlist_id), PRIMARY KEY (track_id, playlist_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE track_style (track_id INT NOT NULL, style_id INT NOT NULL, INDEX IDX_434A1ACD5ED23C43 (track_id), INDEX IDX_434A1ACDBACD6074 (style_id), PRIMARY KEY (track_id, style_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE track_playlist ADD CONSTRAINT FK_B45DE36C5ED23C43 FOREIGN KEY (track_id) REFERENCES track (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE track_playlist ADD CONSTRAINT FK_B45DE36C6BBD148 FOREIGN KEY (playlist_id) REFERENCES playlist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE track_style ADD CONSTRAINT FK_434A1ACD5ED23C43 FOREIGN KEY (track_id) REFERENCES track (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE track_style ADD CONSTRAINT FK_434A1ACDBACD6074 FOREIGN KEY (style_id) REFERENCES style (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE album ADD artist_id INT NOT NULL');
        $this->addSql('ALTER TABLE album ADD CONSTRAINT FK_39986E43B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id)');
        $this->addSql('CREATE INDEX IDX_39986E43B7970CF8 ON album (artist_id)');
        $this->addSql('ALTER TABLE favorite ADD track_id INT NOT NULL, ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE favorite ADD CONSTRAINT FK_68C58ED95ED23C43 FOREIGN KEY (track_id) REFERENCES track (id)');
        $this->addSql('ALTER TABLE favorite ADD CONSTRAINT FK_68C58ED9A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_68C58ED95ED23C43 ON favorite (track_id)');
        $this->addSql('CREATE INDEX IDX_68C58ED9A76ED395 ON favorite (user_id)');
        $this->addSql('ALTER TABLE listening_log ADD track_id INT NOT NULL, ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE listening_log ADD CONSTRAINT FK_81E376AE5ED23C43 FOREIGN KEY (track_id) REFERENCES track (id)');
        $this->addSql('ALTER TABLE listening_log ADD CONSTRAINT FK_81E376AEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_81E376AE5ED23C43 ON listening_log (track_id)');
        $this->addSql('CREATE INDEX IDX_81E376AEA76ED395 ON listening_log (user_id)');
        $this->addSql('ALTER TABLE playlist ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE playlist ADD CONSTRAINT FK_D782112DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_D782112DA76ED395 ON playlist (user_id)');
        $this->addSql('ALTER TABLE track ADD album_id INT NOT NULL');
        $this->addSql('ALTER TABLE track ADD CONSTRAINT FK_D6E3F8A61137ABCF FOREIGN KEY (album_id) REFERENCES album (id)');
        $this->addSql('CREATE INDEX IDX_D6E3F8A61137ABCF ON track (album_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE track_playlist DROP FOREIGN KEY FK_B45DE36C5ED23C43');
        $this->addSql('ALTER TABLE track_playlist DROP FOREIGN KEY FK_B45DE36C6BBD148');
        $this->addSql('ALTER TABLE track_style DROP FOREIGN KEY FK_434A1ACD5ED23C43');
        $this->addSql('ALTER TABLE track_style DROP FOREIGN KEY FK_434A1ACDBACD6074');
        $this->addSql('DROP TABLE track_playlist');
        $this->addSql('DROP TABLE track_style');
        $this->addSql('ALTER TABLE album DROP FOREIGN KEY FK_39986E43B7970CF8');
        $this->addSql('DROP INDEX IDX_39986E43B7970CF8 ON album');
        $this->addSql('ALTER TABLE album DROP artist_id');
        $this->addSql('ALTER TABLE favorite DROP FOREIGN KEY FK_68C58ED95ED23C43');
        $this->addSql('ALTER TABLE favorite DROP FOREIGN KEY FK_68C58ED9A76ED395');
        $this->addSql('DROP INDEX IDX_68C58ED95ED23C43 ON favorite');
        $this->addSql('DROP INDEX IDX_68C58ED9A76ED395 ON favorite');
        $this->addSql('ALTER TABLE favorite DROP track_id, DROP user_id');
        $this->addSql('ALTER TABLE listening_log DROP FOREIGN KEY FK_81E376AE5ED23C43');
        $this->addSql('ALTER TABLE listening_log DROP FOREIGN KEY FK_81E376AEA76ED395');
        $this->addSql('DROP INDEX IDX_81E376AE5ED23C43 ON listening_log');
        $this->addSql('DROP INDEX IDX_81E376AEA76ED395 ON listening_log');
        $this->addSql('ALTER TABLE listening_log DROP track_id, DROP user_id');
        $this->addSql('ALTER TABLE playlist DROP FOREIGN KEY FK_D782112DA76ED395');
        $this->addSql('DROP INDEX IDX_D782112DA76ED395 ON playlist');
        $this->addSql('ALTER TABLE playlist DROP user_id');
        $this->addSql('ALTER TABLE track DROP FOREIGN KEY FK_D6E3F8A61137ABCF');
        $this->addSql('DROP INDEX IDX_D6E3F8A61137ABCF ON track');
        $this->addSql('ALTER TABLE track DROP album_id');
    }
}
