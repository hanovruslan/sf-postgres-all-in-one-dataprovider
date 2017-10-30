<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\Cache\Adapter\PdoAdapter;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171030215522 extends AbstractMigration implements ContainerAwareInterface
{

    use ContainerAwareTrait;

    /**
     * {@inheritdoc}
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        /**
         * @var PdoAdapter $pdoAdapter
         */
        $pdoAdapter = $this->container->get('app.cache.adapter.pdo');
        $pdoAdapter->createTable();
    }

    /**
     * {@inheritdoc}
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
    }
}
