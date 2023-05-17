<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230506180044 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE actividad (id INT AUTO_INCREMENT NOT NULL, tipo_actividad VARCHAR(100) NOT NULL, id_empresa INT NOT NULL, precio DOUBLE PRECISION NOT NULL, nombre VARCHAR(50) NOT NULL, descripcion VARCHAR(250) DEFAULT NULL, participantes INT NOT NULL, fecha_actividad DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cliente (id INT AUTO_INCREMENT NOT NULL, tipo_actividad VARCHAR(50) DEFAULT NULL, dinero DOUBLE PRECISION NOT NULL, id_usuario INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE empresa (id INT AUTO_INCREMENT NOT NULL, tipo_empresa VARCHAR(50) NOT NULL, dinero DOUBLE PRECISION NOT NULL, id_usuario INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE participante (id INT AUTO_INCREMENT NOT NULL, id_actividad INT NOT NULL, id_cliente INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(50) NOT NULL, email VARCHAR(60) NOT NULL, contrasena VARCHAR(50) NOT NULL, tipo VARCHAR(40) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE actividad');
        $this->addSql('DROP TABLE cliente');
        $this->addSql('DROP TABLE empresa');
        $this->addSql('DROP TABLE participante');
        $this->addSql('DROP TABLE user');
    }
}
