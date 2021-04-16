<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210416083720 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, published_at DATETIME DEFAULT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article_translation (id INT AUTO_INCREMENT NOT NULL, article_id INT NOT NULL, title VARCHAR(255) NOT NULL, locale VARCHAR(5) NOT NULL, INDEX IDX_2EEA2F087294869C (article_id), UNIQUE INDEX UNIQ_2EEA2F087294869C4180C698 (article_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sub_article (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article_translation ADD CONSTRAINT FK_2EEA2F087294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE sub_article ADD CONSTRAINT FK_7DE25292BF396750 FOREIGN KEY (id) REFERENCES article (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article_translation DROP FOREIGN KEY FK_2EEA2F087294869C');
        $this->addSql('ALTER TABLE sub_article DROP FOREIGN KEY FK_7DE25292BF396750');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE article_translation');
        $this->addSql('DROP TABLE sub_article');
    }
}
