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

        $ap_config = ActivityPubConfig::createBuilder()
            ->setDbConnectionParams(array(
                'driver' => 'pdo_mysql',
                'user' => 'flarum',
                'password' => 'flarumpass',
                'host' => 'localhost',
                'port' => 3306,
                'dbname' => 'flarum'
            ))
            ->setIsDevMode(true)
            ->setMetadataMappings(array(
                __DIR__ . '/../../resources/orm_mappings'
            ))
            ->build();
        
        return new ActivityPub( $ap_config );
    }
}