<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210409233418 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, id_parent INT DEFAULT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comments (id INT AUTO_INCREMENT NOT NULL, id_post_id INT NOT NULL, id_parent INT NOT NULL, title VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, author_name VARCHAR(255) NOT NULL, author_email VARCHAR(255) NOT NULL, published TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, published_at DATETIME NOT NULL, INDEX IDX_5F9E962A9514AA5C (id_post_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE languages (id INT AUTO_INCREMENT NOT NULL, iso_code VARCHAR(20) NOT NULL, lang_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE posts (id INT AUTO_INCREMENT NOT NULL, id_category_id INT NOT NULL, author_id INT NOT NULL, created_at DATETIME NOT NULL, published_at DATETIME NOT NULL, published TINYINT(1) NOT NULL, INDEX IDX_885DBAFAA545015 (id_category_id), INDEX IDX_885DBAFAF675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE posts_language (id INT AUTO_INCREMENT NOT NULL, post_id INT NOT NULL, lang_id INT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, short_description LONGTEXT NOT NULL, meta_name VARCHAR(255) NOT NULL, meta_description VARCHAR(255) NOT NULL, meta_keywords VARCHAR(255) NOT NULL, url_key VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_E14A97C4B89032C (post_id), INDEX IDX_E14A97CB213FA4 (lang_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tags (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tags_posts (id INT AUTO_INCREMENT NOT NULL, post_id INT NOT NULL, tag_id INT NOT NULL, UNIQUE INDEX UNIQ_E3394CA24B89032C (post_id), UNIQUE INDEX UNIQ_E3394CA2BAD26311 (tag_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A9514AA5C FOREIGN KEY (id_post_id) REFERENCES posts (id)');
        $this->addSql('ALTER TABLE posts ADD CONSTRAINT FK_885DBAFAA545015 FOREIGN KEY (id_category_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE posts ADD CONSTRAINT FK_885DBAFAF675F31B FOREIGN KEY (author_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE posts_language ADD CONSTRAINT FK_E14A97C4B89032C FOREIGN KEY (post_id) REFERENCES posts (id)');
        $this->addSql('ALTER TABLE posts_language ADD CONSTRAINT FK_E14A97CB213FA4 FOREIGN KEY (lang_id) REFERENCES languages (id)');
        $this->addSql('ALTER TABLE tags_posts ADD CONSTRAINT FK_E3394CA24B89032C FOREIGN KEY (post_id) REFERENCES posts (id)');
        $this->addSql('ALTER TABLE tags_posts ADD CONSTRAINT FK_E3394CA2BAD26311 FOREIGN KEY (tag_id) REFERENCES tags (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE posts DROP FOREIGN KEY FK_885DBAFAA545015');
        $this->addSql('ALTER TABLE posts_language DROP FOREIGN KEY FK_E14A97CB213FA4');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A9514AA5C');
        $this->addSql('ALTER TABLE posts_language DROP FOREIGN KEY FK_E14A97C4B89032C');
        $this->addSql('ALTER TABLE tags_posts DROP FOREIGN KEY FK_E3394CA24B89032C');
        $this->addSql('ALTER TABLE tags_posts DROP FOREIGN KEY FK_E3394CA2BAD26311');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE comments');
        $this->addSql('DROP TABLE languages');
        $this->addSql('DROP TABLE posts');
        $this->addSql('DROP TABLE posts_language');
        $this->addSql('DROP TABLE tags');
        $this->addSql('DROP TABLE tags_posts');
    }
}
