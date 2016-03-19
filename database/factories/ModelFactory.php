<?php
use CHMS\Provider\Models;
use CHMSTests\Provider\Stubs\GenericModel;

$factory->define(Models\User::class, function ($faker) {
    $base = factory(GenericModel::class, 'User')->make()->toArray();
    return array_merge($base, [
    ]);
});

$factory->define(Models\Organization::class, function ($faker) {
    $base = factory(GenericModel::class, 'Organization')->make()->toArray();
    return array_merge($base, [
    ]);
});

$factory->define(Models\Role::class, function ($faker) {
    $base = factory(GenericModel::class, 'Role')->make()->toArray();
    return array_merge($base, []);
});

$factory->defineAs(Models\Role::class, 'student', function ($faker) use ($factory) {
    return [
        'name' => 'Student',
        'system_id' => 'student',
        'context' => 'hub',
    ];
});

$factory->defineAs(Models\Role::class, 'instructor', function ($faker) {
    return [
        'name' => 'Instructor',
        'system_id' => 'instructor',
        'context' => 'provider',
    ];
});

$factory->define(Models\RoleUser::class, function ($faker) {
    $base = factory(GenericModel::class, 'RoleUser')->make()->toArray();
    return array_merge($base, [
        'user_id' => factory(Models\User::class)->create()->id,
        'role_id' => factory(Models\Role::class)->create()->id
    ]);
});

$factory->defineAs(Models\RoleUser::class, 'object', function ($faker) {
    $base = factory(GenericModel::class, 'RoleUser')->make()->toArray();
    return array_merge($base, [
        'user_id' => factory(Models\User::class)->create()->id,
        'role_id' => factory(Models\Role::class)->create()->id,
        'object_id' => factory(Models\ClassRecord::class)->create()->id
    ]);
});

$factory->define(Models\Evaluation::class, function ($faker) {
    $base = factory(GenericModel::class, 'Evaluation')->make()->toArray();
    return array_merge($base, [
    ]);
});

$factory->define(Models\EvaluationQuestion::class, function ($faker) {
    $base = factory(GenericModel::class, 'EvaluationQuestion')->make()->toArray();
    return array_merge($base, [
       'evaluation_id' => factory(Models\Evaluation::class)->create()->id 
    ]);
});

$factory->define(Models\EvaluationQuestionOption::class, function ($faker) {
    $base = factory(GenericModel::class, 'EvaluationQuestionOption')->make()->toArray();
    return array_merge($base, [
       'evaluation_question_id' => factory(Models\EvaluationQuestion::class)->create()->id 
    ]);
});

$factory->define(Models\ClassRecord::class, function ($faker) {
    $base = factory(GenericModel::class, 'ClassRecord')->make()->toArray();
    return array_merge($base, [
       'evaluation_id' => factory(Models\Evaluation::class)->create()->id 
    ]);
});

$factory->define(Models\Location::class, function ($faker) {
    $base = factory(GenericModel::class, 'Location')->make()->toArray();
    return array_merge($base, [
    ]);
});

$factory->define(Models\ClassMeeting::class, function ($faker) {
    $base = factory(GenericModel::class, 'ClassMeeting')->make()->toArray();
    return array_merge($base, [
       'class_record_id' => factory(Models\ClassRecord::class)->create()->id 
    ]);
});

$factory->define(Models\Topic::class, function ($faker) {
    $base = factory(GenericModel::class, 'Topic')->make()->toArray();
    return array_merge($base, [ 
    ]);
});

$factory->define(Models\ClassTopic::class, function ($faker) {
    $base = factory(GenericModel::class, 'ClassTopic')->make()->toArray();
    return array_merge($base, [
       'topic_id' => factory(Models\Topic::class)->create()->id,
       'class_record_id' => factory(Models\ClassRecord::class)->create()->id
    ]);
});

$factory->define(Models\ClockHourRecord::class, function ($faker) {
    $base = factory(GenericModel::class, 'ClockHourRecord')->make()->toArray();
    return array_merge($base, [
        'user_id' => factory(Models\User::class)->create()->id,
        'class_record_id' => factory(Models\ClassRecord::class)->create()->id
    ]);
});


$factory->defineAs(GenericModel::class, 'User', function ($faker) {
    return [
    ];
});

$factory->defineAs(GenericModel::class, 'Organization', function ($faker) {
    return [
    ];
});

$factory->defineAs(GenericModel::class, 'Role', function ($faker) {
    $name = $faker->colorName;
    return [
        'name' => $name,
        'system_id' => strtr(strtolower($name), [' ' => '_']),
        'context' => 'hub',
    ];
});

$factory->defineAs(GenericModel::class, 'RoleUser', function ($faker) {
    return [
        'role_id' => $faker->uuid,
        'user_id' => $faker->uuid,
    ];
});

$factory->defineAs(GenericModel::class, 'Evaluation', function ($faker) {
    return [
        'name' => $faker->catchPhrase
    ];
});

$factory->defineAs(GenericModel::class, 'EvaluationQuestion', function ($faker) {
    return [
        'evaluation_id' => $faker->uuid,
        'question' => $faker->catchPhrase,
        'type' => 'textbox',
        'order' => 0
    ];
});

$factory->defineAs(GenericModel::class, 'EvaluationQuestionOption', function ($faker) {
    return [
        'option_value' => $faker->catchPhrase,
        'order' => 0
    ];
});

$factory->defineAs(GenericModel::class, 'ClassRecord', function ($faker) {
    return [
        'evaluation_id' => $faker->uuid,
        'title' => $faker->catchPhrase,
        'instructional_hours' => round(rand(1,10)),
        'expected_participants' => round(rand(1,100)),
        'has_college_credit' => round(rand(0,1)),
        'college_credit_sponsor' => $faker->company,
        'list_publicly' => round(rand(0,1)),
        'online_class' => round(rand(0,1)),
        'online_start_date' => $faker->date('Y-m-d', '+1 year'),
        'online_end_date' => $faker->date('Y-m-d', '+1 year'),
        'registration_url' => $faker->url,
        'objectives' => $faker->paragraph(),
        'comments' => $faker->paragraph()
    ];
});


$factory->defineAs(GenericModel::class, 'Location', function ($faker) {
    return [
        'name' => 'Primary',
        'address_1' => $faker->streetAddress,
        'address_2' => $faker->secondaryAddress,
        'city' => $faker->city,
        'subnational_division' => $faker->stateAbbr,
        'postal_code' => $faker->postcode,
        'country' => $faker->country,
        'phone_number' => $faker->phoneNumber,
        'fax_number' => $faker->phoneNumber
    ];
});

$factory->defineAs(GenericModel::class, 'ClassMeeting', function ($faker) {
    return [
        'class_record_id' => $faker->uuid,
        'location_id' => $faker->uuid,
        'meeting_date' => $faker->date('Y-m-d', '+1 year'),
        'start_time' => $faker->time('H:i:s', 'now'),
        'end_time' => $faker->time('H:i:s', 'now'),
    ];
});

$factory->defineAs(GenericModel::class, 'Topic', function ($faker) {
    return [
        'name' => $faker->catchPhrase,
    ];
});
$factory->defineAs(GenericModel::class, 'ClassTopic', function ($faker) {
    $name = $faker->colorName;
    return [
        'class_record_id' => $faker->uuid,
        'topic_id' => $faker->uuid,
    ];
});
$factory->defineAs(GenericModel::class, 'ClockHourRecord', function ($faker) {
    $name = $faker->colorName;
    return [
        'user_id' => $faker->uuid,
        'class_record_id' => $faker->uuid,
        'hours_attended' => round(rand(0, 10))
    ];
});




    