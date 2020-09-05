<?php

namespace Application\Migrations;

use AppBundle\Entity\Role;
use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20200905073449 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $roles = array_map(function($role) {
            return "('$role')";
        }, [
            Role::ROLE_ADMIN, Role::ROLE_USER
        ]);

        $rolesString = implode(', ', $roles);

        $this->addSql("INSERT INTO roles(name) VALUES $rolesString");
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('TRUNCATE TABLE roles');
    }
}
