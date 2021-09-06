<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210902033132 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE flight_seat (id INT AUTO_INCREMENT NOT NULL, number VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE flight_seat ADD flight_id INT DEFAULT NULL, ADD passenger_id INT DEFAULT NULL, ADD flight_seat_class_id INT DEFAULT NULL, ADD airplane_id INT NOT NULL, ADD status VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE flight_seat ADD CONSTRAINT FK_BC626B0191F478C5 FOREIGN KEY (flight_id) REFERENCES flight (id)');
        $this->addSql('ALTER TABLE flight_seat ADD CONSTRAINT FK_BC626B014502E565 FOREIGN KEY (passenger_id) REFERENCES passenger (id)');
        $this->addSql('ALTER TABLE flight_seat ADD CONSTRAINT FK_BC626B012F1B681C FOREIGN KEY (flight_seat_class_id) REFERENCES flight_seat_classes (id)');
        $this->addSql('ALTER TABLE flight_seat ADD CONSTRAINT FK_BC626B01996E853C FOREIGN KEY (airplane_id) REFERENCES airplane (id)');
        $this->addSql('CREATE INDEX IDX_BC626B0191F478C5 ON flight_seat (flight_id)');
        $this->addSql('CREATE INDEX IDX_BC626B014502E565 ON flight_seat (passenger_id)');
        $this->addSql('CREATE INDEX IDX_BC626B012F1B681C ON flight_seat (flight_seat_class_id)');
        $this->addSql('CREATE INDEX IDX_BC626B01996E853C ON flight_seat (airplane_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE flight_seat_airplane (flight_seat_id INT NOT NULL, airplane_id INT NOT NULL, INDEX IDX_E32D6321996E853C (airplane_id), INDEX IDX_E32D632142361DA3 (flight_seat_id), PRIMARY KEY(flight_seat_id, airplane_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE flight_seat_flight (flight_seat_id INT NOT NULL, flight_id INT NOT NULL, INDEX IDX_4B7620AF91F478C5 (flight_id), INDEX IDX_4B7620AF42361DA3 (flight_seat_id), PRIMARY KEY(flight_seat_id, flight_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE flight_seat_flight_seat_classes (flight_seat_id INT NOT NULL, flight_seat_classes_id INT NOT NULL, INDEX IDX_8FAC7436E62CE1D1 (flight_seat_classes_id), INDEX IDX_8FAC743642361DA3 (flight_seat_id), PRIMARY KEY(flight_seat_id, flight_seat_classes_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE flight_seat_passenger (flight_seat_id INT NOT NULL, passenger_id INT NOT NULL, INDEX IDX_329CBF954502E565 (passenger_id), INDEX IDX_329CBF9542361DA3 (flight_seat_id), PRIMARY KEY(flight_seat_id, passenger_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE flight_seat_airplane ADD CONSTRAINT FK_E32D632142361DA3 FOREIGN KEY (flight_seat_id) REFERENCES flight_seat (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE flight_seat_airplane ADD CONSTRAINT FK_E32D6321996E853C FOREIGN KEY (airplane_id) REFERENCES airplane (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE flight_seat_flight ADD CONSTRAINT FK_4B7620AF42361DA3 FOREIGN KEY (flight_seat_id) REFERENCES flight_seat (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE flight_seat_flight ADD CONSTRAINT FK_4B7620AF91F478C5 FOREIGN KEY (flight_id) REFERENCES flight (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE flight_seat_flight_seat_classes ADD CONSTRAINT FK_8FAC743642361DA3 FOREIGN KEY (flight_seat_id) REFERENCES flight_seat (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE flight_seat_flight_seat_classes ADD CONSTRAINT FK_8FAC7436E62CE1D1 FOREIGN KEY (flight_seat_classes_id) REFERENCES flight_seat_classes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE flight_seat_passenger ADD CONSTRAINT FK_329CBF9542361DA3 FOREIGN KEY (flight_seat_id) REFERENCES flight_seat (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE flight_seat_passenger ADD CONSTRAINT FK_329CBF954502E565 FOREIGN KEY (passenger_id) REFERENCES passenger (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE flight_seat DROP FOREIGN KEY FK_BC626B0191F478C5');
        $this->addSql('ALTER TABLE flight_seat DROP FOREIGN KEY FK_BC626B014502E565');
        $this->addSql('ALTER TABLE flight_seat DROP FOREIGN KEY FK_BC626B012F1B681C');
        $this->addSql('ALTER TABLE flight_seat DROP FOREIGN KEY FK_BC626B01996E853C');
        $this->addSql('DROP INDEX IDX_BC626B0191F478C5 ON flight_seat');
        $this->addSql('DROP INDEX IDX_BC626B014502E565 ON flight_seat');
        $this->addSql('DROP INDEX IDX_BC626B012F1B681C ON flight_seat');
        $this->addSql('DROP INDEX IDX_BC626B01996E853C ON flight_seat');
        $this->addSql('ALTER TABLE flight_seat DROP flight_id, DROP passenger_id, DROP flight_seat_class_id, DROP airplane_id, DROP status');
    }
}
