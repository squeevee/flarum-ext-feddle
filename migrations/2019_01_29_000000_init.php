<?php

use Illuminate\Database\Schema\Builder;
use Illuminate\Database\Schema\Blueprint;

return [
    'up' => function (Builder $schema) {
        $schema->create('feddle_private_keys', function(Blueprint $table) {
            $table->increments('id')->nullable(false);
            $table->integer('object_id')->default(null);
            $table->string('private_key')->nullable(false);

            $table->index('object_id');
        });
        $schema->create('feddle_activitypub_fields', function(Blueprint $table) {
            $table->increments('id')->nullable(false);
            $table->integer('object_id')->default(null);
            $table->string('name')->nullable(false);
            $table->string('value')->default(null);
            $table->dateTime('created')->nullable(false);
            $table->dateTime('lastUpdated')->nullable(false);
            $table->integer('targetObject_id')->default(null);

            $table->index('object_id');
            $table->index('targetObject_id');
        });
        $schema->create('feddle_activitypub_objects', function(Blueprint $table) {
            $table->increments('id')->nullable(false);
            $table->dateTime('created')->nullable(false);
            $table->dateTime('lastUpdated')->nullable(false);
        });
    },
    'down' => function (Builder $schema) {
        $schema->drop('feddle_private_keys');
        $schema->drop('feddle_activitypub_fields');
        $schema->drop('feddle_activitypub_objects');
    }
];