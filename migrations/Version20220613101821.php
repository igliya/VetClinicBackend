<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220613101821 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE animal_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE breed_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE checkup_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE client_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE kind_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE payment_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE service_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE timetable_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE animal (id INT NOT NULL, breed_id INT NOT NULL, name VARCHAR(255) NOT NULL, birthday DATE NOT NULL, sex BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6AAB231FA8B4A30F ON animal (breed_id)');
        $this->addSql('CREATE TABLE breed (id INT NOT NULL, kind_id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F8AF884F30602CA9 ON breed (kind_id)');
        $this->addSql('CREATE TABLE checkup (id INT NOT NULL, doctor_id INT NOT NULL, animal_id INT NOT NULL, start_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, end_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, complaints VARCHAR(512) NOT NULL, diagnosis VARCHAR(512) NOT NULL, treatment VARCHAR(512) NOT NULL, type SMALLINT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_FD1B7CAF87F4FB17 ON checkup (doctor_id)');
        $this->addSql('CREATE INDEX IDX_FD1B7CAF8E962C16 ON checkup (animal_id)');
        $this->addSql('CREATE TABLE checkup_service (service_id INT NOT NULL, checkup_id INT NOT NULL, price DOUBLE PRECISION NOT NULL, PRIMARY KEY(service_id, checkup_id))');
        $this->addSql('CREATE INDEX IDX_14C55264ED5CA9E6 ON checkup_service (service_id)');
        $this->addSql('CREATE INDEX IDX_14C55264BD8A2086 ON checkup_service (checkup_id)');
        $this->addSql('CREATE TABLE client (id INT NOT NULL, account_id INT NOT NULL, phone VARCHAR(15) NOT NULL, address VARCHAR(512) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C74404559B6B5FBA ON client (account_id)');
        $this->addSql('CREATE TABLE kind (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE payment (id INT NOT NULL, checkup_id INT NOT NULL, registrar_id INT DEFAULT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, amount DOUBLE PRECISION NOT NULL, status SMALLINT NOT NULL, type BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6D28840DBD8A2086 ON payment (checkup_id)');
        $this->addSql('CREATE INDEX IDX_6D28840DD1AA2FC1 ON payment (registrar_id)');
        $this->addSql('CREATE TABLE service (id INT NOT NULL, name VARCHAR(255) NOT NULL, status BOOLEAN NOT NULL, price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE timetable (id INT NOT NULL, doctor_id INT NOT NULL, day SMALLINT NOT NULL, work_start TIME(0) WITHOUT TIME ZONE NOT NULL, work_end TIME(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6B1F67087F4FB17 ON timetable (doctor_id)');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, patronymic VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231FA8B4A30F FOREIGN KEY (breed_id) REFERENCES breed (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE breed ADD CONSTRAINT FK_F8AF884F30602CA9 FOREIGN KEY (kind_id) REFERENCES kind (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE checkup ADD CONSTRAINT FK_FD1B7CAF87F4FB17 FOREIGN KEY (doctor_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE checkup ADD CONSTRAINT FK_FD1B7CAF8E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE checkup_service ADD CONSTRAINT FK_14C55264ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE checkup_service ADD CONSTRAINT FK_14C55264BD8A2086 FOREIGN KEY (checkup_id) REFERENCES checkup (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C74404559B6B5FBA FOREIGN KEY (account_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840DBD8A2086 FOREIGN KEY (checkup_id) REFERENCES checkup (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840DD1AA2FC1 FOREIGN KEY (registrar_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE timetable ADD CONSTRAINT FK_6B1F67087F4FB17 FOREIGN KEY (doctor_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE checkup DROP CONSTRAINT FK_FD1B7CAF8E962C16');
        $this->addSql('ALTER TABLE animal DROP CONSTRAINT FK_6AAB231FA8B4A30F');
        $this->addSql('ALTER TABLE checkup_service DROP CONSTRAINT FK_14C55264BD8A2086');
        $this->addSql('ALTER TABLE payment DROP CONSTRAINT FK_6D28840DBD8A2086');
        $this->addSql('ALTER TABLE breed DROP CONSTRAINT FK_F8AF884F30602CA9');
        $this->addSql('ALTER TABLE checkup_service DROP CONSTRAINT FK_14C55264ED5CA9E6');
        $this->addSql('ALTER TABLE checkup DROP CONSTRAINT FK_FD1B7CAF87F4FB17');
        $this->addSql('ALTER TABLE client DROP CONSTRAINT FK_C74404559B6B5FBA');
        $this->addSql('ALTER TABLE payment DROP CONSTRAINT FK_6D28840DD1AA2FC1');
        $this->addSql('ALTER TABLE timetable DROP CONSTRAINT FK_6B1F67087F4FB17');
        $this->addSql('DROP SEQUENCE animal_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE breed_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE checkup_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE client_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE kind_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE payment_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE service_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE timetable_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('DROP TABLE animal');
        $this->addSql('DROP TABLE breed');
        $this->addSql('DROP TABLE checkup');
        $this->addSql('DROP TABLE checkup_service');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE kind');
        $this->addSql('DROP TABLE payment');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE timetable');
        $this->addSql('DROP TABLE "user"');
    }
}
