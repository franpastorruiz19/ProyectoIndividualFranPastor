<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230508201343 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cliente ADD CONSTRAINT FK_F41C9B25FCF8192D FOREIGN KEY (id_usuario) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_F41C9B25FCF8192D ON cliente (id_usuario)');
        $this->addSql('ALTER TABLE empresa ADD CONSTRAINT FK_B8D75A50FCF8192D FOREIGN KEY (id_usuario) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_B8D75A50FCF8192D ON empresa (id_usuario)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cliente DROP FOREIGN KEY FK_F41C9B25FCF8192D');
        $this->addSql('DROP INDEX IDX_F41C9B25FCF8192D ON cliente');
        $this->addSql('ALTER TABLE empresa DROP FOREIGN KEY FK_B8D75A50FCF8192D');
        $this->addSql('DROP INDEX IDX_B8D75A50FCF8192D ON empresa');
    }
}
