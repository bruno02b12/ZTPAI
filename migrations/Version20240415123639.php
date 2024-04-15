<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240415123639 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE UNIQUE INDEX UNIQ_10D52C6B10D52C6B ON cuisine (cuisine)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BDDB8949BDDB8949 ON dietary_type (dietary_type)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FE5F9A66FE5F9A66 ON fraction (fraction)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6BAF78706BAF7870 ON ingredient (ingredient)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F3C50DF6F3C50DF6 ON recipe_type (recipe_type)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_DCBB0C53DCBB0C53 ON unit (unit)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_DCBB0C534D4901 ON unit (abbr)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_229E97AF229E97AF ON user_action (user_action)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F65F1BE0F65F1BE0 ON user_type (user_type)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_10D52C6B10D52C6B ON cuisine');
        $this->addSql('DROP INDEX UNIQ_BDDB8949BDDB8949 ON dietary_type');
        $this->addSql('DROP INDEX UNIQ_FE5F9A66FE5F9A66 ON fraction');
        $this->addSql('DROP INDEX UNIQ_6BAF78706BAF7870 ON ingredient');
        $this->addSql('DROP INDEX UNIQ_F3C50DF6F3C50DF6 ON recipe_type');
        $this->addSql('DROP INDEX UNIQ_DCBB0C53DCBB0C53 ON unit');
        $this->addSql('DROP INDEX UNIQ_DCBB0C534D4901 ON unit');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74 ON user');
        $this->addSql('DROP INDEX UNIQ_229E97AF229E97AF ON user_action');
        $this->addSql('DROP INDEX UNIQ_F65F1BE0F65F1BE0 ON user_type');
    }
}
