<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240221155425 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create table trip';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE trip (id SERIAL NOT NULL, vehicle_id INT NOT NULL, driver_id INT NOT NULL, date DATE NOT NULL, PRIMARY KEY(id), CONSTRAINT FK_VEHICLE_TRIP FOREIGN KEY (vehicle_id) REFERENCES vehicles (id) ON DELETE CASCADE, CONSTRAINT FK_DRIVER_TRIP FOREIGN KEY (driver_id) REFERENCES drivers (id) ON DELETE CASCADE)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE trip');
    }
}
