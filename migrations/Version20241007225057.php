<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241007225057 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // Convert integer to string and then to timestamp
        $this->addSql('ALTER TABLE episode ALTER duration TYPE TIMESTAMP(0) WITHOUT TIME ZONE USING to_timestamp(duration::double precision)');
        $this->addSql('COMMENT ON COLUMN episode.duration IS \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // Convert timestamp back to integer
        $this->addSql('ALTER TABLE episode ALTER duration TYPE INT USING extract(epoch from duration)::integer');
        $this->addSql('COMMENT ON COLUMN episode.duration IS NULL');
    }
}