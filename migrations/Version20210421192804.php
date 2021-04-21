<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210421192804 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE posts_language');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A4B89032C');
        $this->addSql('DROP INDEX IDX_5F9E962A4B89032C ON comments');
        $this->addSql('ALTER TABLE comments DROP post_id');
        $this->addSql('ALTER TABLE posts ADD title VARCHAR(255) NOT NULL, ADD description LONGTEXT NOT NULL, ADD short_description VARCHAR(255) NOT NULL, ADD image VARCHAR(255) NOT NULL, ADD meta_name VARCHAR(255) NOT NULL, ADD meta_keywords VARCHAR(255) NOT NULL, ADD meta_description VARCHAR(255) DEFAULT NULL, ADD url_key VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE tags_posts DROP FOREIGN KEY FK_E3394CA24B89032C');
        $this->addSql('DROP INDEX UNIQ_E3394CA24B89032C ON tags_posts');
        $this->addSql('ALTER TABLE tags_posts DROP post_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE posts_language (id INT AUTO_INCREMENT NOT NULL, post_id INT NOT NULL, lang_id INT NOT NULL, title VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, short_description LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, meta_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, meta_description VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, meta_keywords VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, url_key VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_E14A97CB213FA4 (lang_id), UNIQUE INDEX UNIQ_E14A97C4B89032C (post_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE posts_language ADD CONSTRAINT FK_E14A97C4B89032C FOREIGN KEY (post_id) REFERENCES posts (id)');
        $this->addSql('ALTER TABLE posts_language ADD CONSTRAINT FK_E14A97CB213FA4 FOREIGN KEY (lang_id) REFERENCES languages (id)');
        $this->addSql('ALTER TABLE comments ADD post_id INT NOT NULL');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A4B89032C FOREIGN KEY (post_id) REFERENCES posts (id)');
        $this->addSql('CREATE INDEX IDX_5F9E962A4B89032C ON comments (post_id)');
        $this->addSql('ALTER TABLE posts DROP title, DROP description, DROP short_description, DROP image, DROP meta_name, DROP meta_keywords, DROP meta_description, DROP url_key');
        $this->addSql('ALTER TABLE tags_posts ADD post_id INT NOT NULL');
        $this->addSql('ALTER TABLE tags_posts ADD CONSTRAINT FK_E3394CA24B89032C FOREIGN KEY (post_id) REFERENCES posts (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E3394CA24B89032C ON tags_posts (post_id)');
    }
}
