<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200509142201 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE question DROP CONSTRAINT fk_b6f7494e1c118cfe');
        $this->addSql('DROP INDEX idx_b6f7494e1c118cfe');
        $this->addSql('ALTER TABLE question RENAME COLUMN sheet_id_id TO sheet_id');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E8B1206A5 FOREIGN KEY (sheet_id) REFERENCES sheet (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_B6F7494E8B1206A5 ON question (sheet_id)');
        $this->addSql('ALTER TABLE result DROP CONSTRAINT fk_136ac113a04d2819');
        $this->addSql('ALTER TABLE result DROP CONSTRAINT fk_136ac113f01282f1');
        $this->addSql('DROP INDEX idx_136ac113a04d2819');
        $this->addSql('DROP INDEX idx_136ac113f01282f1');
        $this->addSql('ALTER TABLE result ADD series_number INT NOT NULL');
        $this->addSql('ALTER TABLE result ADD group_number INT NOT NULL');
        $this->addSql('ALTER TABLE result DROP series_number_id');
        $this->addSql('ALTER TABLE result DROP group_number_id');
        $this->addSql('ALTER TABLE result ADD CONSTRAINT FK_136AC113F5E3FC69 FOREIGN KEY (series_number) REFERENCES series (series_number) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE result ADD CONSTRAINT FK_136AC1134516C784 FOREIGN KEY (group_number) REFERENCES "group" (group_number) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_136AC113F5E3FC69 ON result (series_number)');
        $this->addSql('CREATE INDEX IDX_136AC1134516C784 ON result (group_number)');
        $this->addSql('ALTER TABLE sheet DROP CONSTRAINT fk_873c91e29d86650f');
        $this->addSql('ALTER TABLE sheet DROP CONSTRAINT fk_873c91e2a04d2819');
        $this->addSql('ALTER TABLE sheet DROP CONSTRAINT fk_873c91e2f01282f1');
        $this->addSql('DROP INDEX idx_873c91e29d86650f');
        $this->addSql('DROP INDEX idx_873c91e2a04d2819');
        $this->addSql('DROP INDEX idx_873c91e2f01282f1');
        $this->addSql('ALTER TABLE sheet ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE sheet ADD series_number INT NOT NULL');
        $this->addSql('ALTER TABLE sheet ADD group_number INT NOT NULL');
        $this->addSql('ALTER TABLE sheet DROP user_id_id');
        $this->addSql('ALTER TABLE sheet DROP series_number_id');
        $this->addSql('ALTER TABLE sheet DROP group_number_id');
        $this->addSql('ALTER TABLE sheet ADD CONSTRAINT FK_873C91E2A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sheet ADD CONSTRAINT FK_873C91E2F5E3FC69 FOREIGN KEY (series_number) REFERENCES series (series_number) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sheet ADD CONSTRAINT FK_873C91E24516C784 FOREIGN KEY (group_number) REFERENCES "group" (group_number) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_873C91E2A76ED395 ON sheet (user_id)');
        $this->addSql('CREATE INDEX IDX_873C91E2F5E3FC69 ON sheet (series_number)');
        $this->addSql('CREATE INDEX IDX_873C91E24516C784 ON sheet (group_number)');
        $this->addSql('ALTER TABLE student DROP CONSTRAINT fk_b723af339d86650f');
        $this->addSql('ALTER TABLE student DROP CONSTRAINT fk_b723af336ed73160');
        $this->addSql('DROP INDEX idx_b723af336ed73160');
        $this->addSql('DROP INDEX idx_b723af339d86650f');
        $this->addSql('ALTER TABLE student ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE student ADD avatar_id INT NOT NULL');
        $this->addSql('ALTER TABLE student DROP user_id_id');
        $this->addSql('ALTER TABLE student DROP avatar_id_id');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF33A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF3386383B10 FOREIGN KEY (avatar_id) REFERENCES avatar (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_B723AF33A76ED395 ON student (user_id)');
        $this->addSql('CREATE INDEX IDX_B723AF3386383B10 ON student (avatar_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE student DROP CONSTRAINT FK_B723AF33A76ED395');
        $this->addSql('ALTER TABLE student DROP CONSTRAINT FK_B723AF3386383B10');
        $this->addSql('DROP INDEX IDX_B723AF33A76ED395');
        $this->addSql('DROP INDEX IDX_B723AF3386383B10');
        $this->addSql('ALTER TABLE student ADD user_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE student ADD avatar_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE student DROP user_id');
        $this->addSql('ALTER TABLE student DROP avatar_id');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT fk_b723af339d86650f FOREIGN KEY (user_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT fk_b723af336ed73160 FOREIGN KEY (avatar_id_id) REFERENCES avatar (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_b723af336ed73160 ON student (avatar_id_id)');
        $this->addSql('CREATE INDEX idx_b723af339d86650f ON student (user_id_id)');
        $this->addSql('ALTER TABLE question DROP CONSTRAINT FK_B6F7494E8B1206A5');
        $this->addSql('DROP INDEX IDX_B6F7494E8B1206A5');
        $this->addSql('ALTER TABLE question RENAME COLUMN sheet_id TO sheet_id_id');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT fk_b6f7494e1c118cfe FOREIGN KEY (sheet_id_id) REFERENCES sheet (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_b6f7494e1c118cfe ON question (sheet_id_id)');
        $this->addSql('ALTER TABLE result DROP CONSTRAINT FK_136AC113F5E3FC69');
        $this->addSql('ALTER TABLE result DROP CONSTRAINT FK_136AC1134516C784');
        $this->addSql('DROP INDEX IDX_136AC113F5E3FC69');
        $this->addSql('DROP INDEX IDX_136AC1134516C784');
        $this->addSql('ALTER TABLE result ADD series_number_id INT NOT NULL');
        $this->addSql('ALTER TABLE result ADD group_number_id INT NOT NULL');
        $this->addSql('ALTER TABLE result DROP series_number');
        $this->addSql('ALTER TABLE result DROP group_number');
        $this->addSql('ALTER TABLE result ADD CONSTRAINT fk_136ac113a04d2819 FOREIGN KEY (series_number_id) REFERENCES series (series_number) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE result ADD CONSTRAINT fk_136ac113f01282f1 FOREIGN KEY (group_number_id) REFERENCES "group" (group_number) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_136ac113a04d2819 ON result (series_number_id)');
        $this->addSql('CREATE INDEX idx_136ac113f01282f1 ON result (group_number_id)');
        $this->addSql('ALTER TABLE sheet DROP CONSTRAINT FK_873C91E2A76ED395');
        $this->addSql('ALTER TABLE sheet DROP CONSTRAINT FK_873C91E2F5E3FC69');
        $this->addSql('ALTER TABLE sheet DROP CONSTRAINT FK_873C91E24516C784');
        $this->addSql('DROP INDEX IDX_873C91E2A76ED395');
        $this->addSql('DROP INDEX IDX_873C91E2F5E3FC69');
        $this->addSql('DROP INDEX IDX_873C91E24516C784');
        $this->addSql('ALTER TABLE sheet ADD user_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE sheet ADD series_number_id INT NOT NULL');
        $this->addSql('ALTER TABLE sheet ADD group_number_id INT NOT NULL');
        $this->addSql('ALTER TABLE sheet DROP user_id');
        $this->addSql('ALTER TABLE sheet DROP series_number');
        $this->addSql('ALTER TABLE sheet DROP group_number');
        $this->addSql('ALTER TABLE sheet ADD CONSTRAINT fk_873c91e29d86650f FOREIGN KEY (user_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sheet ADD CONSTRAINT fk_873c91e2a04d2819 FOREIGN KEY (series_number_id) REFERENCES series (series_number) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sheet ADD CONSTRAINT fk_873c91e2f01282f1 FOREIGN KEY (group_number_id) REFERENCES "group" (group_number) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_873c91e29d86650f ON sheet (user_id_id)');
        $this->addSql('CREATE INDEX idx_873c91e2a04d2819 ON sheet (series_number_id)');
        $this->addSql('CREATE INDEX idx_873c91e2f01282f1 ON sheet (group_number_id)');
    }
}
