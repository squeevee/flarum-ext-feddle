<?php

namespace Squeevee\Feddle\ActivityPub;

use ActivityPub\ActivityPub;
use ActivityPub\Config\ActivityPubConfig;
use Flarum\Foundation\Application;

class ActivityPubFactory
{
    private $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function makeActivityPub()
    {
        $flarum_config = $this->app->make('flarum.config');
        $database_config = $flarum_config['database'];

        if ($database_config['driver'] !== 'mysql') {
            //unsupported
            return null;
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
            ->setMetadataMappings(array(
                __DIR__ . '/../../resources/orm_mappings'
            ))
            ->build();
        
        return new ActivityPub( $ap_config );
    }
}