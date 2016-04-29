<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Initial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registry', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->uuid('id')->primary()->collation('ascii_bin');
            $table->string('model_class', 150);
            $table->dateTime('created_at');
        });


        Schema::create('sponsors', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->uuid('id')->primary()->collation('ascii_bin');
            // $table->uuid('organization_id')->nullable()->collation('ascii_bin');
            $table->string('name');
            $table->string('api_secret', 60);
            $table->string('slug', 20)->unique();
            $table->dateTime('deleted_at')->nullable();
            $table->uuid('deleted_by')->nullable()->collation('ascii_bin');
            $table->dateTime('updated_at')->nullable();
            $table->uuid('updated_by')->nullable()->collation('ascii_bin');
            $table->dateTime('created_at')->nullable();
            $table->uuid('created_by')->nullable()->collation('ascii_bin');

            $table->foreign('id')->references('id')->on('registry')->onDelete('CASCADE')->onUpdate('CASCADE');
            // $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('created_by')->references('id')->on('registry')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('updated_by')->references('id')->on('registry')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('deleted_by')->references('id')->on('registry')->onDelete('SET NULL')->onUpdate('CASCADE');
        });

        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->uuid('id')->primary()->collation('ascii_bin');
            $table->dateTime('created_at')->nullable();
            $table->foreign('id')->references('id')->on('registry')->onDelete('CASCADE')->onUpdate('CASCADE');
        });

        Schema::create('clients', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->uuid('id')->primary()->collation('ascii_bin');
            $table->dateTime('created_at')->nullable();
            $table->foreign('id')->references('id')->on('registry')->onDelete('CASCADE')->onUpdate('CASCADE');
        });

        Schema::create('organizations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->uuid('id')->primary()->collation('ascii_bin');
            $table->dateTime('created_at')->nullable();
            $table->foreign('id')->references('id')->on('registry')->onDelete('CASCADE')->onUpdate('CASCADE');
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->uuid('id')->primary()->collation('ascii_bin');
            $table->string('context', 20);
            $table->string('system_id', 50)->unique();
            $table->string('name', 100);
            $table->dateTime('updated_at')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->foreign('id')->references('id')->on('registry')->onDelete('CASCADE')->onUpdate('CASCADE');
        });

        Schema::create('role_users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->uuid('user_id')->collation('ascii_bin');
            $table->uuid('role_id')->collation('ascii_bin');
            $table->uuid('sponsor_id')->collation('ascii_bin')->nullable();
            $table->uuid('object_id')->collation('ascii_bin')->nullable();
            $table->text('meta')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('object_id')->references('id')->on('registry')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('sponsor_id')->references('id')->on('sponsors')->onDelete('CASCADE')->onUpdate('CASCADE');
        });


        Schema::create('evaluations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->uuid('id')->primary()->collation('ascii_bin');
            $table->uuid('sponsor_id')->collation('ascii_bin');
            $table->string('name');
            $table->dateTime('deleted_at')->nullable();
            $table->uuid('deleted_by')->nullable()->collation('ascii_bin');
            $table->dateTime('updated_at')->nullable();
            $table->uuid('updated_by')->nullable()->collation('ascii_bin');
            $table->dateTime('created_at')->nullable();
            $table->uuid('created_by')->nullable()->collation('ascii_bin');
            $table->unique(['sponsor_id', 'name']);
            $table->foreign('id')->references('id')->on('registry')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('sponsor_id')->references('id')->on('sponsors')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('created_by')->references('id')->on('registry')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('deleted_by')->references('id')->on('registry')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('updated_by')->references('id')->on('registry')->onDelete('SET NULL')->onUpdate('CASCADE');
        });

        Schema::create('evaluation_questions', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->uuid('id')->primary()->collation('ascii_bin');
            $table->uuid('evaluation_id')->collation('ascii_bin');
            $table->string('question');
            $table->string('type', 15);
            $table->integer('order')->default(0);
            $table->dateTime('updated_at')->nullable();
            $table->uuid('updated_by')->nullable()->collation('ascii_bin');
            $table->dateTime('created_at')->nullable();
            $table->uuid('created_by')->nullable()->collation('ascii_bin');
            $table->foreign('id')->references('id')->on('registry')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('evaluation_id')->references('id')->on('evaluations')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('created_by')->references('id')->on('registry')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('updated_by')->references('id')->on('registry')->onDelete('SET NULL')->onUpdate('CASCADE');
        });

        Schema::create('evaluation_question_options', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->uuid('id')->primary()->collation('ascii_bin');
            $table->uuid('evaluation_question_id')->collation('ascii_bin');
            $table->string('option_value');
            $table->integer('order')->default(0);
            $table->dateTime('updated_at')->nullable();
            $table->uuid('updated_by')->nullable()->collation('ascii_bin');
            $table->dateTime('created_at')->nullable();
            $table->uuid('created_by')->nullable()->collation('ascii_bin');
            $table->foreign('id')->references('id')->on('registry')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('evaluation_question_id')->references('id')->on('evaluation_questions')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('created_by')->references('id')->on('registry')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('updated_by')->references('id')->on('registry')->onDelete('SET NULL')->onUpdate('CASCADE');
        });

        Schema::create('class_records', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->uuid('id')->primary()->collation('ascii_bin');
            $table->uuid('sponsor_id')->collation('ascii_bin');
            $table->uuid('evaluation_id')->collation('ascii_bin')->nullable();
            $table->string('title');
            $table->decimal('instructional_hours');
            $table->integer('expected_participants');
            $table->boolean('has_college_credit')->default(0);
            $table->string('college_credit_sponsor')->nullable();
            $table->boolean('list_publicly')->default(0);
            $table->boolean('online_class')->default(0);
            $table->date('online_start_date')->nullable();
            $table->date('online_end_date')->nullable();
            $table->string('registration_url')->nullable();
            $table->text('objectives');
            $table->text('comments');

            $table->dateTime('submitted_at')->nullable();
            $table->dateTime('verified_at')->nullable();
            $table->dateTime('committee_emailed_at')->nullable();
            $table->dateTime('committee_approved_at')->nullable();
            $table->dateTime('approved_at')->nullable();

            $table->dateTime('deleted_at')->nullable();
            $table->uuid('deleted_by')->nullable()->collation('ascii_bin');
            $table->dateTime('updated_at')->nullable();
            $table->uuid('updated_by')->nullable()->collation('ascii_bin');
            $table->dateTime('created_at')->nullable();
            $table->uuid('created_by')->nullable()->collation('ascii_bin');

            $table->foreign('id')->references('id')->on('registry')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('sponsor_id')->references('id')->on('sponsors')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('evaluation_id')->references('id')->on('evaluations')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('created_by')->references('id')->on('registry')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('updated_by')->references('id')->on('registry')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('deleted_by')->references('id')->on('registry')->onDelete('SET NULL')->onUpdate('CASCADE');
        });

        Schema::create('locations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->uuid('id')->primary()->collation('ascii_bin');
            $table->uuid('sponsor_id')->collation('ascii_bin');
            $table->string('name');
            $table->string('address_1')->nullable();
            $table->string('address_2')->nullable();
            $table->string('city', 100)->nullable();
            $table->string('subnational_division', 10)->nullable();
            $table->string('postal_code', 20)->nullable();
            $table->string('country', 100)->nullable();
            $table->string('phone_number', 40)->nullable();
            $table->string('fax_number', 40)->nullable();

            $table->dateTime('updated_at')->nullable();
            $table->uuid('updated_by')->nullable()->collation('ascii_bin');
            $table->dateTime('created_at')->nullable();
            $table->uuid('created_by')->nullable()->collation('ascii_bin');

            $table->foreign('id')->references('id')->on('class_records')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('sponsor_id')->references('id')->on('sponsors')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('created_by')->references('id')->on('registry')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('updated_by')->references('id')->on('registry')->onDelete('SET NULL')->onUpdate('CASCADE');
        });

        Schema::create('class_meetings', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->uuid('id')->primary()->collation('ascii_bin');
            $table->uuid('class_record_id')->collation('ascii_bin');
            $table->uuid('location_id')->collation('ascii_bin')->nullable();
            $table->date('meeting_date');
            $table->time('start_time');
            $table->time('end_time');

            $table->dateTime('updated_at')->nullable();
            $table->uuid('updated_by')->nullable()->collation('ascii_bin');
            $table->dateTime('created_at')->nullable();
            $table->uuid('created_by')->nullable()->collation('ascii_bin');

            $table->foreign('id')->references('id')->on('registry')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('class_record_id')->references('id')->on('class_records')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('created_by')->references('id')->on('registry')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('updated_by')->references('id')->on('registry')->onDelete('SET NULL')->onUpdate('CASCADE');
        });


        Schema::create('topics', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->uuid('id')->primary()->collation('ascii_bin');
            $table->uuid('sponsor_id')->collation('ascii_bin');
            $table->string('name');
            $table->dateTime('created_at')->nullable();
            $table->unique(['sponsor_id', 'name']);
            $table->foreign('sponsor_id')->references('id')->on('sponsors')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('id')->references('id')->on('registry')->onDelete('CASCADE')->onUpdate('CASCADE');
        });

        Schema::create('class_topics', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->uuid('id')->primary()->collation('ascii_bin');
            $table->uuid('class_record_id')->collation('ascii_bin');
            $table->uuid('topic_id')->collation('ascii_bin');

            $table->dateTime('created_at')->nullable();
            $table->uuid('created_by')->nullable()->collation('ascii_bin');

            $table->foreign('id')->references('id')->on('registry')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('class_record_id')->references('id')->on('class_records')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('topic_id')->references('id')->on('topics')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('created_by')->references('id')->on('registry')->onDelete('SET NULL')->onUpdate('CASCADE');
        });

        Schema::create('clock_hour_records', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->uuid('id')->primary()->collation('ascii_bin');
            $table->uuid('user_id')->collation('ascii_bin');
            $table->uuid('class_record_id')->collation('ascii_bin');

            $table->float('hours_attended', 4, 1)->default(0);
            $table->dateTime('evaluation_sent_at')->nullable();
            $table->dateTime('attendance_confirmed_at')->nullable();
            $table->dateTime('hub_recorded_at')->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->uuid('deleted_by')->nullable()->collation('ascii_bin');
            $table->dateTime('updated_at')->nullable();
            $table->uuid('updated_by')->nullable()->collation('ascii_bin');
            $table->dateTime('created_at')->nullable();
            $table->uuid('created_by')->nullable()->collation('ascii_bin');
            $table->index(['user_id', 'evaluation_sent_at', 'attendance_confirmed_at'], 'record_major_index');
            $table->unique(['user_id', 'class_record_id']);
            $table->foreign('id')->references('id')->on('registry')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('class_record_id')->references('id')->on('class_records')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('created_by')->references('id')->on('registry')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('deleted_by')->references('id')->on('registry')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('updated_by')->references('id')->on('registry')->onDelete('SET NULL')->onUpdate('CASCADE');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $tables = [
            'clock_hour_records',
            'class_topics',
            'topics',
            'class_meetings',
            'locations',
            'class_records',
            'evaluation_question_options',
            'evaluation_questions',
            'evaluations',
            'role_users',
            'roles',
            'organizations',
            'users',
            'clients',
            'sponsors',
            'registry'
        ];
        foreach ($tables as $table) {
            if (Schema::hasTable($table)) {
                Schema::drop($table);
            }
        }
    }
}
