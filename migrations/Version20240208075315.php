<?php

declare(strict_types=1);

namespace project\migrations;

use App\Entity\Sex;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240208075315 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE users_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE sex_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql(<<<SQL
            CREATE TABLE users (
                id INT NOT NULL,
                sex_id INT DEFAULT NULL,
                email VARCHAR(255) NOT NULL,
                name VARCHAR(255) NOT NULL,
                age INT NOT NULL,
                birthday TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL,
                phone BIGINT NOT NULL,
                created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL,
                updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL,
                PRIMARY KEY(id))
        SQL);
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D5428AEDE7927C74 ON users (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D5428AED444F97DD ON users (phone)');
        $this->addSql('CREATE INDEX IDX_1483A5E95A2DB2A0 ON users (sex_id)');
        $this->addSql('CREATE TABLE sex (id INT NOT NULL, sex VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql(<<<SQL
            ALTER TABLE users
                ADD CONSTRAINT FK_D5428AED5A2DB2A0
                FOREIGN KEY (sex_id) REFERENCES sex (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);

        $this->addSql(<<<SQL
            INSERT INTO sex (id, sex) VALUES (:id, :sex) 
        SQL,
            ['id' => Sex::MAN, 'sex' => 'Мужчина']
        );

        $this->addSql(<<<SQL
            INSERT INTO sex (id, sex) VALUES (:id, :sex) 
        SQL,
            ['id' => Sex::WOMAN, 'sex' => 'Женщина']
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP SEQUENCE Users_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE sex_id_seq CASCADE');
        $this->addSql('DROP INDEX IDX_1483A5E95A2DB2A0');
        $this->addSql('ALTER TABLE users DROP CONSTRAINT FK_D5428AED5A2DB2A0');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE sex');
    }
}
