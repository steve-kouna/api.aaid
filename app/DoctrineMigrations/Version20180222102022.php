<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180222102022 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE associations__members_inscription (associations_id INT NOT NULL, members_id INT NOT NULL, sessions_id INT NOT NULL, active TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX fk_param__associations_has_member__memebers_member__memeber_idx (members_id), INDEX fk_param__associations_has_member__memebers_param__associat_idx (associations_id), INDEX fk_associations__memebers_param__sessios1_idx (sessions_id), PRIMARY KEY(associations_id, members_id, sessions_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE auth_tokens (id INT AUTO_INCREMENT NOT NULL, members_id INT DEFAULT NULL, associations_id INT DEFAULT NULL, sessions_id INT DEFAULT NULL, value VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_8AF9B66CBD01F5ED (members_id), INDEX IDX_8AF9B66C4122538A (associations_id), INDEX IDX_8AF9B66CF17C4D8C (sessions_id), UNIQUE INDEX auth_tokens_value_unique (value), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE member__emprunt (chest_id INT NOT NULL, members_id INT NOT NULL, sessions_id INT NOT NULL, param__associations_id INT NOT NULL, amount NUMERIC(10, 0) NOT NULL, refund_date DATETIME NOT NULL, refund_amount NUMERIC(10, 0) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX fk_param__chest_has_member__members_member__members1_idx (members_id), INDEX fk_param__chest_has_member__members_param__chest1_idx (chest_id), INDEX fk_member__emprunt_param__associations1_idx (param__associations_id), INDEX fk_member__emprunt_param__sessions1_idx (sessions_id), PRIMARY KEY(chest_id, members_id, sessions_id, param__associations_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE members__offices (sessions_id INT NOT NULL, members_id INT NOT NULL, associations_id INT NOT NULL, offices_id INT NOT NULL, created_at DATETIME NOT NULL, update_at DATETIME DEFAULT NULL, INDEX fk_sys__members_has_param__offices_param__offices1_idx (offices_id), INDEX fk_sys__members_has_param__offices_sys__members1_idx (members_id), INDEX fk_sys__members_has_param__offices_sys__sessions1_idx (sessions_id), INDEX fk_sys__members_has_param__offices_sys__associations1_idx (associations_id), PRIMARY KEY(sessions_id, members_id, associations_id, offices_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE members__sanctions (sessions_id INT NOT NULL, sanctions_id INT NOT NULL, member_id INT NOT NULL, active TINYINT(1) NOT NULL, penalty NUMERIC(10, 0) DEFAULT NULL, date_end DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX fk_member__memeber_has_param__sanctions_param__sanctions1_idx (sanctions_id), INDEX fk_member__memeber_has_param__sanctions_member__memeber_idx (member_id), INDEX fk_memebers__sanctions_param__sessions1_idx (sessions_id), PRIMARY KEY(sessions_id, sanctions_id, member_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sys__history (id INT AUTO_INCREMENT NOT NULL, members_id INT DEFAULT NULL, libel VARCHAR(45) NOT NULL, description VARCHAR(45) DEFAULT NULL, INDEX fk_sys__history_member__members1_idx (members_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sys__members (id INT AUTO_INCREMENT NOT NULL, roles TINYTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', email VARCHAR(100) NOT NULL, password VARCHAR(100) NOT NULL, username VARCHAR(45) NOT NULL, firstname VARCHAR(45) DEFAULT NULL, lastname VARCHAR(45) DEFAULT NULL, date_birth DATE DEFAULT NULL, sexe VARCHAR(45) DEFAULT NULL, cni_number VARCHAR(45) DEFAULT NULL, date_cni_deliver DATE DEFAULT NULL, UNIQUE INDEX UNIQ_4931A5CAE7927C74 (email), UNIQUE INDEX UNIQ_4931A5CAF85E0677 (username), UNIQUE INDEX cni_number_UNIQUE (cni_number), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sys__transactions (id INT AUTO_INCREMENT NOT NULL, sessions_id INT DEFAULT NULL, chest_id INT DEFAULT NULL, associations_id INT DEFAULT NULL, members_id INT DEFAULT NULL, montant NUMERIC(10, 0) NOT NULL, created_at DATETIME NOT NULL, INDEX fk_sys__transactions_param__chest1_idx (chest_id), INDEX fk_sys__transactions_member__memebers1_idx (members_id), INDEX fk_sys__transactions_param__associations1_idx (associations_id), INDEX fk_sys__transactions_param__sessions1_idx (sessions_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contributions__eat (meeting_id INT NOT NULL, sessions_id INT NOT NULL, contributions_id INT NOT NULL, associations_id INT NOT NULL, members_id INT NOT NULL, eat_id INT NOT NULL, created_at DATETIME NOT NULL, INDEX fk_param__meeting_has_param__associations_param__associatio_idx (associations_id), INDEX fk_param__meeting_has_param__associations_param__meeting1_idx (meeting_id), INDEX fk_param__meeting_has_param__associations_param__contributi_idx (contributions_id), INDEX fk_param__meeting_has_param__associations_member__members1_idx (members_id), INDEX fk_param__meeting_has_param__associations_param__sessions1_idx (sessions_id), INDEX fk_contributions__eat_param_eat1_idx (eat_id), PRIMARY KEY(meeting_id, sessions_id, contributions_id, associations_id, members_id, eat_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE param__contributions (id INT AUTO_INCREMENT NOT NULL, associations_id INT DEFAULT NULL, libel VARCHAR(100) NOT NULL, description LONGTEXT DEFAULT NULL, amount NUMERIC(10, 0) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX fk_param__contributions_param__associations1_idx (associations_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE param_eat (id INT AUTO_INCREMENT NOT NULL, sessions_id INT DEFAULT NULL, meeting_id INT DEFAULT NULL, contributions_id INT DEFAULT NULL, associations_id INT DEFAULT NULL, members_id INT DEFAULT NULL, eat_date DATE NOT NULL, created_at DATETIME NOT NULL, INDEX fk_param_eat_param__meeting1_idx (meeting_id), INDEX fk_param_eat_param__associations1_idx (associations_id), INDEX fk_param_eat_param__contributions1_idx (contributions_id), INDEX fk_param_eat_member__members1_idx (members_id), INDEX fk_param_eat_param__sessions1_idx (sessions_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE param__meeting (id INT AUTO_INCREMENT NOT NULL, sessions_id INT DEFAULT NULL, associations_id INT DEFAULT NULL, members_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, reception_date DATE NOT NULL, place VARCHAR(100) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX fk_param__meeting_param__associations1_idx (associations_id), INDEX fk_param__meeting_param__sessions1_idx (sessions_id), INDEX fk_param__meeting_member__members1_idx (members_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE param__offices (id INT AUTO_INCREMENT NOT NULL, associations_id INT DEFAULT NULL, name VARCHAR(45) NOT NULL, description LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX fk_param__offices_sys__associations1_idx (associations_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE param__sanctions (id INT AUTO_INCREMENT NOT NULL, association_id INT DEFAULT NULL, libel VARCHAR(100) NOT NULL, description LONGTEXT DEFAULT NULL, amount NUMERIC(10, 0) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX fk_param__sanctions_param__associations1_idx (association_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sanctions__notifications (members_id INT NOT NULL, sanctions_id INT NOT NULL, view TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_74771D96BD01F5ED (members_id), INDEX IDX_74771D961A85A49E (sanctions_id), PRIMARY KEY(members_id, sanctions_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sys__associations (id INT AUTO_INCREMENT NOT NULL, acronym VARCHAR(255) NOT NULL, is_delete TINYINT(1) NOT NULL, name VARCHAR(255) NOT NULL, slogan VARCHAR(255) DEFAULT NULL, logo VARCHAR(45) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX name_UNIQUE (name), UNIQUE INDEX slogan_UNIQUE (slogan), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sys__chest (id INT AUTO_INCREMENT NOT NULL, sessions_id INT DEFAULT NULL, associations_id INT DEFAULT NULL, name VARCHAR(45) DEFAULT NULL, description LONGTEXT DEFAULT NULL, amount NUMERIC(10, 0) DEFAULT NULL, INDEX fk_param__chest_param__associations1_idx (associations_id), INDEX fk_param__chest_param__sessions1_idx (sessions_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sys__sessions (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, begin_date DATE NOT NULL, end_date DATE NOT NULL, active TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE associations__members_inscription ADD CONSTRAINT FK_5B48A5214122538A FOREIGN KEY (associations_id) REFERENCES sys__associations (id)');
        $this->addSql('ALTER TABLE associations__members_inscription ADD CONSTRAINT FK_5B48A521BD01F5ED FOREIGN KEY (members_id) REFERENCES sys__members (id)');
        $this->addSql('ALTER TABLE associations__members_inscription ADD CONSTRAINT FK_5B48A521F17C4D8C FOREIGN KEY (sessions_id) REFERENCES sys__sessions (id)');
        $this->addSql('ALTER TABLE auth_tokens ADD CONSTRAINT FK_8AF9B66CBD01F5ED FOREIGN KEY (members_id) REFERENCES sys__members (id)');
        $this->addSql('ALTER TABLE auth_tokens ADD CONSTRAINT FK_8AF9B66C4122538A FOREIGN KEY (associations_id) REFERENCES sys__associations (id)');
        $this->addSql('ALTER TABLE auth_tokens ADD CONSTRAINT FK_8AF9B66CF17C4D8C FOREIGN KEY (sessions_id) REFERENCES sys__sessions (id)');
        $this->addSql('ALTER TABLE member__emprunt ADD CONSTRAINT FK_B5D53340180955AC FOREIGN KEY (chest_id) REFERENCES sys__chest (id)');
        $this->addSql('ALTER TABLE member__emprunt ADD CONSTRAINT FK_B5D53340BD01F5ED FOREIGN KEY (members_id) REFERENCES sys__members (id)');
        $this->addSql('ALTER TABLE member__emprunt ADD CONSTRAINT FK_B5D53340F17C4D8C FOREIGN KEY (sessions_id) REFERENCES sys__sessions (id)');
        $this->addSql('ALTER TABLE member__emprunt ADD CONSTRAINT FK_B5D533404E29A116 FOREIGN KEY (param__associations_id) REFERENCES sys__associations (id)');
        $this->addSql('ALTER TABLE members__offices ADD CONSTRAINT FK_BAB56ECAF17C4D8C FOREIGN KEY (sessions_id) REFERENCES sys__sessions (id)');
        $this->addSql('ALTER TABLE members__offices ADD CONSTRAINT FK_BAB56ECABD01F5ED FOREIGN KEY (members_id) REFERENCES sys__members (id)');
        $this->addSql('ALTER TABLE members__offices ADD CONSTRAINT FK_BAB56ECA4122538A FOREIGN KEY (associations_id) REFERENCES sys__associations (id)');
        $this->addSql('ALTER TABLE members__offices ADD CONSTRAINT FK_BAB56ECADB8DF936 FOREIGN KEY (offices_id) REFERENCES param__offices (id)');
        $this->addSql('ALTER TABLE members__sanctions ADD CONSTRAINT FK_B7DBC63DF17C4D8C FOREIGN KEY (sessions_id) REFERENCES sys__sessions (id)');
        $this->addSql('ALTER TABLE members__sanctions ADD CONSTRAINT FK_B7DBC63D1A85A49E FOREIGN KEY (sanctions_id) REFERENCES param__sanctions (id)');
        $this->addSql('ALTER TABLE members__sanctions ADD CONSTRAINT FK_B7DBC63D7597D3FE FOREIGN KEY (member_id) REFERENCES sys__members (id)');
        $this->addSql('ALTER TABLE sys__history ADD CONSTRAINT FK_2B2B077EBD01F5ED FOREIGN KEY (members_id) REFERENCES sys__members (id)');
        $this->addSql('ALTER TABLE sys__transactions ADD CONSTRAINT FK_25E52854F17C4D8C FOREIGN KEY (sessions_id) REFERENCES sys__sessions (id)');
        $this->addSql('ALTER TABLE sys__transactions ADD CONSTRAINT FK_25E52854180955AC FOREIGN KEY (chest_id) REFERENCES sys__chest (id)');
        $this->addSql('ALTER TABLE sys__transactions ADD CONSTRAINT FK_25E528544122538A FOREIGN KEY (associations_id) REFERENCES sys__associations (id)');
        $this->addSql('ALTER TABLE sys__transactions ADD CONSTRAINT FK_25E52854BD01F5ED FOREIGN KEY (members_id) REFERENCES sys__members (id)');
        $this->addSql('ALTER TABLE contributions__eat ADD CONSTRAINT FK_9F80980467433D9C FOREIGN KEY (meeting_id) REFERENCES param__meeting (id)');
        $this->addSql('ALTER TABLE contributions__eat ADD CONSTRAINT FK_9F809804F17C4D8C FOREIGN KEY (sessions_id) REFERENCES sys__sessions (id)');
        $this->addSql('ALTER TABLE contributions__eat ADD CONSTRAINT FK_9F809804525F2C4B FOREIGN KEY (contributions_id) REFERENCES param__contributions (id)');
        $this->addSql('ALTER TABLE contributions__eat ADD CONSTRAINT FK_9F8098044122538A FOREIGN KEY (associations_id) REFERENCES sys__associations (id)');
        $this->addSql('ALTER TABLE contributions__eat ADD CONSTRAINT FK_9F809804BD01F5ED FOREIGN KEY (members_id) REFERENCES sys__members (id)');
        $this->addSql('ALTER TABLE contributions__eat ADD CONSTRAINT FK_9F80980430F44A5E FOREIGN KEY (eat_id) REFERENCES param_eat (id)');
        $this->addSql('ALTER TABLE param__contributions ADD CONSTRAINT FK_A64E76314122538A FOREIGN KEY (associations_id) REFERENCES sys__associations (id)');
        $this->addSql('ALTER TABLE param_eat ADD CONSTRAINT FK_25EA20A3F17C4D8C FOREIGN KEY (sessions_id) REFERENCES sys__sessions (id)');
        $this->addSql('ALTER TABLE param_eat ADD CONSTRAINT FK_25EA20A367433D9C FOREIGN KEY (meeting_id) REFERENCES param__meeting (id)');
        $this->addSql('ALTER TABLE param_eat ADD CONSTRAINT FK_25EA20A3525F2C4B FOREIGN KEY (contributions_id) REFERENCES param__contributions (id)');
        $this->addSql('ALTER TABLE param_eat ADD CONSTRAINT FK_25EA20A34122538A FOREIGN KEY (associations_id) REFERENCES sys__associations (id)');
        $this->addSql('ALTER TABLE param_eat ADD CONSTRAINT FK_25EA20A3BD01F5ED FOREIGN KEY (members_id) REFERENCES sys__members (id)');
        $this->addSql('ALTER TABLE param__meeting ADD CONSTRAINT FK_DC174180F17C4D8C FOREIGN KEY (sessions_id) REFERENCES sys__sessions (id)');
        $this->addSql('ALTER TABLE param__meeting ADD CONSTRAINT FK_DC1741804122538A FOREIGN KEY (associations_id) REFERENCES sys__associations (id)');
        $this->addSql('ALTER TABLE param__meeting ADD CONSTRAINT FK_DC174180BD01F5ED FOREIGN KEY (members_id) REFERENCES sys__members (id)');
        $this->addSql('ALTER TABLE param__offices ADD CONSTRAINT FK_DC765FF54122538A FOREIGN KEY (associations_id) REFERENCES sys__associations (id)');
        $this->addSql('ALTER TABLE param__sanctions ADD CONSTRAINT FK_BEDB8AF8EFB9C8A5 FOREIGN KEY (association_id) REFERENCES sys__associations (id)');
        $this->addSql('ALTER TABLE sanctions__notifications ADD CONSTRAINT FK_74771D96BD01F5ED FOREIGN KEY (members_id) REFERENCES sys__members (id)');
        $this->addSql('ALTER TABLE sanctions__notifications ADD CONSTRAINT FK_74771D961A85A49E FOREIGN KEY (sanctions_id) REFERENCES param__sanctions (id)');
        $this->addSql('ALTER TABLE sys__chest ADD CONSTRAINT FK_9508D2C6F17C4D8C FOREIGN KEY (sessions_id) REFERENCES sys__sessions (id)');
        $this->addSql('ALTER TABLE sys__chest ADD CONSTRAINT FK_9508D2C64122538A FOREIGN KEY (associations_id) REFERENCES sys__associations (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE associations__members_inscription DROP FOREIGN KEY FK_5B48A521BD01F5ED');
        $this->addSql('ALTER TABLE auth_tokens DROP FOREIGN KEY FK_8AF9B66CBD01F5ED');
        $this->addSql('ALTER TABLE member__emprunt DROP FOREIGN KEY FK_B5D53340BD01F5ED');
        $this->addSql('ALTER TABLE members__offices DROP FOREIGN KEY FK_BAB56ECABD01F5ED');
        $this->addSql('ALTER TABLE members__sanctions DROP FOREIGN KEY FK_B7DBC63D7597D3FE');
        $this->addSql('ALTER TABLE sys__history DROP FOREIGN KEY FK_2B2B077EBD01F5ED');
        $this->addSql('ALTER TABLE sys__transactions DROP FOREIGN KEY FK_25E52854BD01F5ED');
        $this->addSql('ALTER TABLE contributions__eat DROP FOREIGN KEY FK_9F809804BD01F5ED');
        $this->addSql('ALTER TABLE param_eat DROP FOREIGN KEY FK_25EA20A3BD01F5ED');
        $this->addSql('ALTER TABLE param__meeting DROP FOREIGN KEY FK_DC174180BD01F5ED');
        $this->addSql('ALTER TABLE sanctions__notifications DROP FOREIGN KEY FK_74771D96BD01F5ED');
        $this->addSql('ALTER TABLE contributions__eat DROP FOREIGN KEY FK_9F809804525F2C4B');
        $this->addSql('ALTER TABLE param_eat DROP FOREIGN KEY FK_25EA20A3525F2C4B');
        $this->addSql('ALTER TABLE contributions__eat DROP FOREIGN KEY FK_9F80980430F44A5E');
        $this->addSql('ALTER TABLE contributions__eat DROP FOREIGN KEY FK_9F80980467433D9C');
        $this->addSql('ALTER TABLE param_eat DROP FOREIGN KEY FK_25EA20A367433D9C');
        $this->addSql('ALTER TABLE members__offices DROP FOREIGN KEY FK_BAB56ECADB8DF936');
        $this->addSql('ALTER TABLE members__sanctions DROP FOREIGN KEY FK_B7DBC63D1A85A49E');
        $this->addSql('ALTER TABLE sanctions__notifications DROP FOREIGN KEY FK_74771D961A85A49E');
        $this->addSql('ALTER TABLE associations__members_inscription DROP FOREIGN KEY FK_5B48A5214122538A');
        $this->addSql('ALTER TABLE auth_tokens DROP FOREIGN KEY FK_8AF9B66C4122538A');
        $this->addSql('ALTER TABLE member__emprunt DROP FOREIGN KEY FK_B5D533404E29A116');
        $this->addSql('ALTER TABLE members__offices DROP FOREIGN KEY FK_BAB56ECA4122538A');
        $this->addSql('ALTER TABLE sys__transactions DROP FOREIGN KEY FK_25E528544122538A');
        $this->addSql('ALTER TABLE contributions__eat DROP FOREIGN KEY FK_9F8098044122538A');
        $this->addSql('ALTER TABLE param__contributions DROP FOREIGN KEY FK_A64E76314122538A');
        $this->addSql('ALTER TABLE param_eat DROP FOREIGN KEY FK_25EA20A34122538A');
        $this->addSql('ALTER TABLE param__meeting DROP FOREIGN KEY FK_DC1741804122538A');
        $this->addSql('ALTER TABLE param__offices DROP FOREIGN KEY FK_DC765FF54122538A');
        $this->addSql('ALTER TABLE param__sanctions DROP FOREIGN KEY FK_BEDB8AF8EFB9C8A5');
        $this->addSql('ALTER TABLE sys__chest DROP FOREIGN KEY FK_9508D2C64122538A');
        $this->addSql('ALTER TABLE member__emprunt DROP FOREIGN KEY FK_B5D53340180955AC');
        $this->addSql('ALTER TABLE sys__transactions DROP FOREIGN KEY FK_25E52854180955AC');
        $this->addSql('ALTER TABLE associations__members_inscription DROP FOREIGN KEY FK_5B48A521F17C4D8C');
        $this->addSql('ALTER TABLE auth_tokens DROP FOREIGN KEY FK_8AF9B66CF17C4D8C');
        $this->addSql('ALTER TABLE member__emprunt DROP FOREIGN KEY FK_B5D53340F17C4D8C');
        $this->addSql('ALTER TABLE members__offices DROP FOREIGN KEY FK_BAB56ECAF17C4D8C');
        $this->addSql('ALTER TABLE members__sanctions DROP FOREIGN KEY FK_B7DBC63DF17C4D8C');
        $this->addSql('ALTER TABLE sys__transactions DROP FOREIGN KEY FK_25E52854F17C4D8C');
        $this->addSql('ALTER TABLE contributions__eat DROP FOREIGN KEY FK_9F809804F17C4D8C');
        $this->addSql('ALTER TABLE param_eat DROP FOREIGN KEY FK_25EA20A3F17C4D8C');
        $this->addSql('ALTER TABLE param__meeting DROP FOREIGN KEY FK_DC174180F17C4D8C');
        $this->addSql('ALTER TABLE sys__chest DROP FOREIGN KEY FK_9508D2C6F17C4D8C');
        $this->addSql('DROP TABLE associations__members_inscription');
        $this->addSql('DROP TABLE auth_tokens');
        $this->addSql('DROP TABLE member__emprunt');
        $this->addSql('DROP TABLE members__offices');
        $this->addSql('DROP TABLE members__sanctions');
        $this->addSql('DROP TABLE sys__history');
        $this->addSql('DROP TABLE sys__members');
        $this->addSql('DROP TABLE sys__transactions');
        $this->addSql('DROP TABLE contributions__eat');
        $this->addSql('DROP TABLE param__contributions');
        $this->addSql('DROP TABLE param_eat');
        $this->addSql('DROP TABLE param__meeting');
        $this->addSql('DROP TABLE param__offices');
        $this->addSql('DROP TABLE param__sanctions');
        $this->addSql('DROP TABLE sanctions__notifications');
        $this->addSql('DROP TABLE sys__associations');
        $this->addSql('DROP TABLE sys__chest');
        $this->addSql('DROP TABLE sys__sessions');
    }
}
