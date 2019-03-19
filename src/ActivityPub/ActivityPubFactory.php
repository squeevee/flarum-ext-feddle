<?php

namespace Squeevee\Feddle\ActivityPub;

use ActivityPub\ActivityPub;
use ActivityPub\Config\ActivityPubConfig;
use Illuminate\Contracts\Container\Container;

class ActivityPubFactory
{
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function makeActivityPub()
    {
        $flarum_config = $this->container->make('flarum.config');
        $database_config = $flarum_config['database'];

        if ($database_config['driver'] !== 'mysql') {
            throw new Exception('Unsupported database driver');
        }

        $ap_config = ActivityPubConfig::createBuilder()
            ->setDbConnectionParams(array(
                'driver' => 'pdo_mysql',
                'user' => $database_config['username'],
                'password' => $database_config['password'],
                'host' => $database_config['host'],
                'port' => intval($database_config['port']),
                'dbname' => $database_config['database']
            ))
            ->setIsDevMode($flarum_config['debug'])
            /*->setMetadataMappings(array(
                __DIR__ . '/../../resources/orm_mappings'
            ))*/
            ->setDbPrefix($database_config['prefix'] . 'feddle_')
            ->build();
        
        return new ActivityPub( $ap_config );
    }
}