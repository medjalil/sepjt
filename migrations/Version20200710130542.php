<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200710130542 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipment ADD task_id INT NOT NULL');
        $this->addSql('ALTER TABLE equipment ADD CONSTRAINT FK_D338D5838DB60186 FOREIGN KEY (task_id) REFERENCES task (id)');
        $this->addSql('CREATE INDEX IDX_D338D5838DB60186 ON equipment (task_id)');
        $this->addSql('ALTER TABLE worker ADD task_id INT NOT NULL');
        $this->addSql('ALTER TABLE worker ADD CONSTRAINT FK_9FB2BF628DB60186 FOREIGN KEY (task_id) REFERENCES task (id)');
        $this->addSql('CREATE INDEX IDX_9FB2BF628DB60186 ON worker (task_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipment DROP FOREIGN KEY FK_D338D5838DB60186');
        $this->addSql('DROP INDEX IDX_D338D5838DB60186 ON equipment');
        $this->addSql('ALTER TABLE equipment DROP task_id');
        $this->addSql('ALTER TABLE worker DROP FOREIGN KEY FK_9FB2BF628DB60186');
        $this->addSql('DROP INDEX IDX_9FB2BF628DB60186 ON worker');
        $this->addSql('ALTER TABLE worker DROP task_id');
    }
}
