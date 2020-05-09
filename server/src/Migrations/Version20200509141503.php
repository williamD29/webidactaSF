<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200509141503 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE avatar_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE question_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE result_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE sheet_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE student_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE avatar (id INT NOT NULL, url VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "group" (group_number INT NOT NULL, PRIMARY KEY(group_number))');
        $this->addSql('CREATE TABLE question (id INT NOT NULL, sheet_id_id INT NOT NULL, question_number INT NOT NULL, answer_1 VARCHAR(255) DEFAULT NULL, answer_2 VARCHAR(255) DEFAULT NULL, answer_3 VARCHAR(255) DEFAULT NULL, image_1 VARCHAR(255) DEFAULT NULL, image_2 VARCHAR(255) DEFAULT NULL, image_3 VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B6F7494E1C118CFE ON question (sheet_id_id)');
        $this->addSql('CREATE TABLE result (id INT NOT NULL, series_number_id INT NOT NULL, group_number_id INT NOT NULL, question_number INT NOT NULL, answer_number INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_136AC113A04D2819 ON result (series_number_id)');
        $this->addSql('CREATE INDEX IDX_136AC113F01282F1 ON result (group_number_id)');
        $this->addSql('CREATE TABLE series (series_number INT NOT NULL, PRIMARY KEY(series_number))');
        $this->addSql('CREATE TABLE sheet (id INT NOT NULL, user_id_id INT NOT NULL, series_number_id INT NOT NULL, group_number_id INT NOT NULL, title VARCHAR(80) NOT NULL, global_question VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_873C91E29D86650F ON sheet (user_id_id)');
        $this->addSql('CREATE INDEX IDX_873C91E2A04D2819 ON sheet (series_number_id)');
        $this->addSql('CREATE INDEX IDX_873C91E2F01282F1 ON sheet (group_number_id)');
        $this->addSql('CREATE TABLE sheet_student (sheet_id INT NOT NULL, student_id INT NOT NULL, PRIMARY KEY(sheet_id, student_id))');
        $this->addSql('CREATE INDEX IDX_3B5FBA8E8B1206A5 ON sheet_student (sheet_id)');
        $this->addSql('CREATE INDEX IDX_3B5FBA8ECB944F1A ON sheet_student (student_id)');
        $this->addSql('CREATE TABLE student (id INT NOT NULL, user_id_id INT NOT NULL, avatar_id_id INT NOT NULL, firstname VARCHAR(40) NOT NULL, lastname VARCHAR(40) NOT NULL, difficulty INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B723AF339D86650F ON student (user_id_id)');
        $this->addSql('CREATE INDEX IDX_B723AF336ED73160 ON student (avatar_id_id)');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, firstname VARCHAR(40) NOT NULL, lastname VARCHAR(40) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(60) NOT NULL, profile_picture VARCHAR(255) DEFAULT NULL, is_admin BOOLEAN DEFAULT \'false\' NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E1C118CFE FOREIGN KEY (sheet_id_id) REFERENCES sheet (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE result ADD CONSTRAINT FK_136AC113A04D2819 FOREIGN KEY (series_number_id) REFERENCES series (series_number) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE result ADD CONSTRAINT FK_136AC113F01282F1 FOREIGN KEY (group_number_id) REFERENCES "group" (group_number) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sheet ADD CONSTRAINT FK_873C91E29D86650F FOREIGN KEY (user_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sheet ADD CONSTRAINT FK_873C91E2A04D2819 FOREIGN KEY (series_number_id) REFERENCES series (series_number) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sheet ADD CONSTRAINT FK_873C91E2F01282F1 FOREIGN KEY (group_number_id) REFERENCES "group" (group_number) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sheet_student ADD CONSTRAINT FK_3B5FBA8E8B1206A5 FOREIGN KEY (sheet_id) REFERENCES sheet (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sheet_student ADD CONSTRAINT FK_3B5FBA8ECB944F1A FOREIGN KEY (student_id) REFERENCES student (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF339D86650F FOREIGN KEY (user_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF336ED73160 FOREIGN KEY (avatar_id_id) REFERENCES avatar (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE student DROP CONSTRAINT FK_B723AF336ED73160');
        $this->addSql('ALTER TABLE result DROP CONSTRAINT FK_136AC113F01282F1');
        $this->addSql('ALTER TABLE sheet DROP CONSTRAINT FK_873C91E2F01282F1');
        $this->addSql('ALTER TABLE result DROP CONSTRAINT FK_136AC113A04D2819');
        $this->addSql('ALTER TABLE sheet DROP CONSTRAINT FK_873C91E2A04D2819');
        $this->addSql('ALTER TABLE question DROP CONSTRAINT FK_B6F7494E1C118CFE');
        $this->addSql('ALTER TABLE sheet_student DROP CONSTRAINT FK_3B5FBA8E8B1206A5');
        $this->addSql('ALTER TABLE sheet_student DROP CONSTRAINT FK_3B5FBA8ECB944F1A');
        $this->addSql('ALTER TABLE sheet DROP CONSTRAINT FK_873C91E29D86650F');
        $this->addSql('ALTER TABLE student DROP CONSTRAINT FK_B723AF339D86650F');
        $this->addSql('DROP SEQUENCE avatar_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE question_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE result_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE sheet_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE student_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('DROP TABLE avatar');
        $this->addSql('DROP TABLE "group"');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE result');
        $this->addSql('DROP TABLE series');
        $this->addSql('DROP TABLE sheet');
        $this->addSql('DROP TABLE sheet_student');
        $this->addSql('DROP TABLE student');
        $this->addSql('DROP TABLE "user"');
    }
}
