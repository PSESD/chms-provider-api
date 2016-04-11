<?php
/**
 * Clock Hour Management System - Provider
 *
 * @copyright Copyright (c) 2016 Puget Sound Educational Service District
 * @license   Proprietary
 */

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Illuminate\Http\Response;
use CHMS\Provider\Repositories\Contracts\RoleRepository;

/**
 * Path: /providers/{providerId}/
 */
$app->addRoute('GET', '/', function () use ($app) {
    //\dump($provider);
    return ['okay'];
});


/**
 * Path: /providers/{providerId}/version
 */
$app->addRoute('GET', '/version', function () use ($app) {
    return ['version' => $app->version()];
});

$primaryMiddleware = ['oauth', 'oauth-user', 'auth:user', 'auth-route'];
$clientMiddleware = ['oauth', 'oauth-client', 'auth:client', 'auth-route'];
$mixMiddleware = ['oauth', 'auth:*', 'auth-route'];



$app->group(['namespace' => 'CHMS\Provider\Http\Controllers', 'middleware' => $clientMiddleware], function ($app) {

    /**
     * Path: /provider
     */
    $app->addRoute('GET', '/providers', ['as' => 'getProviders', 'uses' => 'Providers\IndexController@get']);
    $app->addRoute('POST', '/providers', ['as' => 'postProviders', 'uses' => 'Providers\IndexController@post']);


    /**
     * Path: /providers/{providerId}
     */
    $app->addRoute('HEAD', '/providers/{providerId}', ['as' => 'headProviderObject', 'uses' => 'Providers\ObjectController@head']);
    $app->addRoute('GET', '/providers/{providerId}', ['as' => 'getProviderObject', 'uses' => 'Providers\ObjectController@get']);
    $app->addRoute('PATCH', '/providers/{providerId}', ['as' => 'patchProviderObject', 'uses' => 'Providers\ObjectController@patch']);
    $app->addRoute('DELETE', '/providers/{providerId}', ['as' => 'deleteProviderObject', 'uses' => 'Providers\ObjectController@delete']);
});


$app->group(['namespace' => 'CHMS\Provider\Http\Controllers', 'middleware' => $clientMiddleware], function ($app) {

    /**
     * Path: /providers/{providerId}/classes/{classId}/evaluationResponses
     */
    $app->addRoute('POST', '/providers/{providerId}/classes/{classId}/evaluationResponses', ['as' => 'postEvaluationResponse', 'uses' => 'Classes\EvaluationController@post']);
});


$app->group(['namespace' => 'CHMS\Provider\Http\Controllers', 'middleware' => $mixMiddleware], function ($app) {
    /**
     * Path: /providers/{providerId}/classes/{classId}
     */
    $app->addRoute('HEAD', '/providers/{providerId}/classes/{classId}', ['as' => 'headClassObject', 'uses' => 'Classes\ObjectController@head']);
    $app->addRoute('GET', '/providers/{providerId}/classes/{classId}', ['as' => 'getClassObject', 'uses' => 'Classes\ObjectController@get']);

    /**
     * Path: /providers/{providerId}/classes/{classId}/meetings
     */
    $app->addRoute('GET', '/providers/{providerId}/classes/{classId}/meetings', ['as' => 'getMeetings', 'uses' => 'Classes\MeetingController@get']);


    /**
     * Path: /providers/{providerId}/classes/{classId}/meetings/{meetingId}
     */
    $app->addRoute('HEAD', '/providers/{providerId}/classes/{classId}/meetings/{meetingId}', ['as' => 'headMeetingObject', 'uses' => 'Classes\MeetingController@headObject']);
    $app->addRoute('GET', '/providers/{providerId}/classes/{classId}/meetings/{meetingId}', ['as' => 'getMeetingObject', 'uses' => 'Classes\MeetingController@getObject']);

    /**
     * Path: /providers/{providerId}/classes/{classId}/instructors
     */
    $app->addRoute('GET', '/providers/{providerId}/classes/{classId}/instructors', ['as' => 'getClassInstructors', 'uses' => 'Classes\InstructorController@get']);
    $app->addRoute('POST', '/providers/{providerId}/classes/{classId}/instructors', ['as' => 'postClassInstructors', 'uses' => 'Classes\InstructorController@post']);

    /**
     * Path: /providers/{providerId}/classes/{classId}/topics
     */
    $app->addRoute('GET', '/providers/{providerId}/classes/{classId}/topics', ['as' => 'getClassTopics', 'uses' => 'Classes\TopicController@get']);

    /**
     * Path: /providers/{providerId}/classes/{classId}/evaluationResponses
     */
    $app->addRoute('GET', '/providers/{providerId}/classes/{classId}/evaluationResponses', ['as' => 'getEvaluationResponses', 'uses' => 'Classes\EvaluationController@get']);

    /**
     * Path: /providers/{providerId}/evaluations
     */
    $app->addRoute('GET', '/providers/{providerId}/evaluations', ['as' => 'getEvaluations', 'uses' => 'Evaluations\IndexController@get']);

    /**
     * Path: /providers/{providerId}/evaluations/{evaluationId}/questions
     */
    $app->addRoute('GET', '/providers/{providerId}/evaluations/{evaluationId}/questions', ['as' => 'getQuestions', 'uses' => 'Evaluations\QuestionController@get']);


    /**
     * Path: /providers/{providerId}/records
     */
    $app->addRoute('GET', '/providers/{providerId}/records',     ['as' => 'getRecords', 'uses' => 'Records\IndexController@get']);

    /**
     * Path: /providers/{providerId}/roles
     */
    $app->addRoute('GET', '/providers/{providerId}/roles',     ['as' => 'getRoles', 'uses' => 'Roles\IndexController@get']);

    /**
     * Path: /providers/{providerId}/roles/{roleId}
     */
    $app->addRoute('HEAD', '/providers/{providerId}/roles/{roleId}', ['as' => 'headRoleObject', 'uses' => 'Roles\ObjectController@head']);
    $app->addRoute('GET', '/providers/{providerId}/roles/{roleId}',    ['as' => 'getRoleObject', 'uses' => 'Roles\ObjectController@get']);

});

$app->group(['namespace' => 'CHMS\Provider\Http\Controllers', 'middleware' => $primaryMiddleware], function ($app) {
    /**
     * Path: /providers/{providerId}/classes
     */
    $app->addRoute('GET', '/providers/{providerId}/classes', ['as' => 'getClasses', 'uses' => 'Classes\IndexController@get']);
    $app->addRoute('POST', '/providers/{providerId}/classes', ['as' => 'postClasses', 'uses' => 'Classes\IndexController@post']);

    /**
     * Path: /providers/{providerId}/classes/{classId}
     */
    $app->addRoute('PATCH', '/providers/{providerId}/classes/{classId}', ['as' => 'patchClassObject', 'uses' => 'Classes\ObjectController@patch']);
    $app->addRoute('DELETE', '/providers/{providerId}/classes/{classId}', ['as' => 'deleteClassObject', 'uses' => 'Classes\ObjectController@delete']);

    /**
     * Path: /providers/{providerId}/classes/{classId}/meetings
     */
    $app->addRoute('POST', '/providers/{providerId}/classes/{classId}/meetings', ['as' => 'postMeetings', 'uses' => 'Classes\MeetingController@post']);

    /**
     * Path: /providers/{providerId}/classes/{classId}/meetings/{meetingId}
     */
    $app->addRoute('PATCH', '/providers/{providerId}/classes/{classId}/meetings/{meetingId}', ['as' => 'patchMeetingObject', 'uses' => 'Classes\MeetingController@patchObject']);
    $app->addRoute('DELETE', '/providers/{providerId}/classes/{classId}/meetings/{meetingId}', ['as' => 'deleteMeetingObject', 'uses' => 'Classes\MeetingController@deleteObject']);

    /**
     * Path: /providers/{providerId}/classes/{classId}/instructors/{instructorId}
     */
    $app->addRoute('HEAD', '/providers/{providerId}/classes/{classId}/instructors/{instructorId}', ['as' => 'headClassInstructor', 'uses' => 'Classes\InstructorController@headRelationship']);
    $app->addRoute('PUT', '/providers/{providerId}/classes/{classId}/instructors/{instructorId}', ['as' => 'getClassInstructor', 'uses' => 'Classes\InstructorController@getRelationship']);
    $app->addRoute('DELETE', '/providers/{providerId}/classes/{classId}/instructors/{instructorId}', ['as' => 'deleteClassInstructor', 'uses' => 'Classes\InstructorController@deleteRelationship']);

    /**
     * Path: /providers/{providerId}/classes/{classId}/topics/{topic}
     */
    $app->addRoute('HEAD', '/providers/{providerId}/classes/{classId}/topics/{topic}', ['as' => 'headClassTopic', 'uses' => 'Classes\TopicController@headRelationship']);
    $app->addRoute('PUT', '/providers/{providerId}/classes/{classId}/topics/{topic}', ['as' => 'getClassTopic', 'uses' => 'Classes\TopicController@getRelationship']);
    $app->addRoute('DELETE', '/providers/{providerId}/classes/{classId}/topics/{topic}', ['as' => 'deleteClassTopic', 'uses' => 'Classes\TopicController@deleteRelationship']);

    /**
     * Path: /providers/{providerId}/classes/{classId}/records
     */
    $app->addRoute('GET', '/providers/{providerId}/classes/{classId}/records', ['as' => 'getClassClockHourRecords', 'uses' => 'Classes\RecordController@get']);
    /**
     * Path: /providers/{providerId}/locations
     */
    $app->addRoute('GET', '/providers/{providerId}/locations', ['as' => 'getLocations', 'uses' => 'Locations\IndexController@get']);
    $app->addRoute('POST', '/providers/{providerId}/locations', ['as' => 'postLocations', 'uses' => 'Locations\IndexController@post']);

    /**
     * Path: /providers/{providerId}/locations/{locationId}
     */
    $app->addRoute('HEAD', '/providers/{providerId}/locations/{locationId}', ['as' => 'headLocationObject', 'uses' => 'Locations\ObjectController@head']);
    $app->addRoute('GET', '/providers/{providerId}/locations/{locationId}', ['as' => 'getLocationObject', 'uses' => 'Locations\ObjectController@get']);
    $app->addRoute('PATCH', '/providers/{providerId}/locations/{locationId}', ['as' => 'patchLocationObject', 'uses' => 'Locations\ObjectController@patch']);
    $app->addRoute('DELETE', '/providers/{providerId}/locations/{locationId}', ['as' => 'deleteLocationObject', 'uses' => 'Locations\ObjectController@delete']);


    /**
     * Path: /providers/{providerId}/topics
     */
    $app->addRoute('GET', '/providers/{providerId}/topics', ['as' => 'getTopics', 'uses' => 'Topics\IndexController@get']);
    $app->addRoute('POST', '/providers/{providerId}/topics', ['as' => 'postTopics', 'uses' => 'Topics\IndexController@post']);

    /**
     * Path: /providers/{providerId}/topics/{topicId}
     */
    $app->addRoute('HEAD', '/providers/{providerId}/topics/{topicId}', ['as' => 'headTopicObject', 'uses' => 'Topics\ObjectController@head']);
    $app->addRoute('GET', '/providers/{providerId}/topics/{topicId}', ['as' => 'getTopicObject', 'uses' => 'Topics\ObjectController@get']);
    $app->addRoute('PATCH', '/providers/{providerId}/topics/{topicId}', ['as' => 'patchTopicObject', 'uses' => 'Topics\ObjectController@patch']);
    $app->addRoute('DELETE', '/providers/{providerId}/topics/{topicId}', ['as' => 'deleteTopicObject', 'uses' => 'Topics\ObjectController@delete']);


    /**
     * Path: /providers/{providerId}/evaluations
     */
    $app->addRoute('POST', '/providers/{providerId}/evaluations', ['as' => 'postEvaluations', 'uses' => 'Evaluations\IndexController@post']);

    /**
     * Path: /providers/{providerId}/evaluations/{evaluationId}
     */
    $app->addRoute('HEAD', '/providers/{providerId}/evaluations/{evaluationId}', ['as' => 'headEvaluationObject', 'uses' => 'Evaluations\ObjectController@head']);
    $app->addRoute('GET', '/providers/{providerId}/evaluations/{evaluationId}', ['as' => 'getEvaluationObject', 'uses' => 'Evaluations\ObjectController@get']);
    $app->addRoute('PATCH', '/providers/{providerId}/evaluations/{evaluationId}', ['as' => 'patchEvaluationObject', 'uses' => 'Evaluations\ObjectController@patch']);
    $app->addRoute('DELETE', '/providers/{providerId}/evaluations/{evaluationId}', ['as' => 'deleteEvaluationObject', 'uses' => 'Evaluations\ObjectController@delete']);

    /**
     * Path: /providers/{providerId}/records
     */
    $app->addRoute('POST', '/providers/{providerId}/records', ['as' => 'postRecords', 'uses' => 'Records\IndexController@post']);

    /**
     * Path: /providers/{providerId}/records/{recordId}
     */
    $app->addRoute('HEAD', '/providers/{providerId}/records/{recordId}', ['as' => 'headRecordObject', 'uses' => 'Records\ObjectController@head']);
    $app->addRoute('GET', '/providers/{providerId}/records/{recordId}', ['as' => 'getRecordObject', 'uses' => 'Records\ObjectController@get']);
    $app->addRoute('PATCH', '/providers/{providerId}/records/{recordId}', ['as' => 'patchRecordObject', 'uses' => 'Records\ObjectController@patch']);
    $app->addRoute('DELETE', '/providers/{providerId}/records/{recordId}', ['as' => 'deleteRecordObject', 'uses' => 'Records\ObjectController@delete']);


    /**
     * Path: /providers/{providerId}/evaluations/{evaluationId}/questions
     */
    $app->addRoute('POST', '/providers/{providerId}/evaluations/{evaluationId}/questions', ['as' => 'postQuestion', 'uses' => 'Evaluations\QuestionController@post']);

    /**
     * Path: /providers/{providerId}/evaluations/{evaluationId}/questions/{questionId}
     */
    $app->addRoute('HEAD', '/providers/{providerId}/evaluations/{evaluationId}/questions/{questionId}', ['as' => 'headQuestionObject', 'uses' => 'Evaluations\QuestionController@headObject']);
    $app->addRoute('GET', '/providers/{providerId}/evaluations/{evaluationId}/questions/{questionId}', ['as' => 'getQuestionObject', 'uses' => 'Evaluations\QuestionController@getObject']);
    $app->addRoute('PATCH', '/providers/{providerId}/evaluations/{evaluationId}/questions/{questionId}', ['as' => 'patchQuestionObject', 'uses' => 'Evaluations\QuestionController@patchObject']);
    $app->addRoute('DELETE', '/providers/{providerId}/evaluations/{evaluationId}/questions/{questionId}', ['as' => 'deleteQuestionObject', 'uses' => 'Evaluations\QuestionController@deleteObject']);
});
