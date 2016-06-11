<?php
/**
 * Clock Hour Management System - Provider Provider
 *
 * @copyright Copyright (c) 2016 Puget Sound Educational Service District
 * @license   Proprietary
 */

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Illuminate\Http\Response;
use CHMS\ProviderHub\Repositories\Contracts\RoleRepository;

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

$app->addRoute('GET', '/handshake', ['uses' => 'CHMS\ProviderHub\Http\Controllers\HandshakeController@get']);
$app->addRoute('POST', '/handshake', ['uses' => 'CHMS\ProviderHub\Http\Controllers\HandshakeController@post']);

$primaryMiddleware = ['auth:user', 'auth-route']; // ['oauth', 'oauth-user', 'auth:user', 'auth-route'];
$clientMiddleware = ['auth:client', 'auth-route']; // ['oauth', 'oauth-client', 'auth:client', 'auth-route'];
$mixMiddleware = ['auth:*', 'auth-route']; // ['oauth', 'auth:*', 'auth-route'];
$providerBaseRoute = '/providers/{providerId}';

$app->group(['namespace' => 'CHMS\ProviderHub\Http\Controllers', 'middleware' => $mixMiddleware], function ($app) use ($providerBaseRoute) {

    /**
     * Path: /provider
     */
    $app->addRoute('GET', '/providers', ['as' => 'getProviders', 'uses' => 'Providers\IndexController@get']);


    /**
     * Path: /providers/{providerId}
     */
    $app->addRoute('HEAD', $providerBaseRoute, ['as' => 'headProviderObject', 'uses' => 'Providers\ObjectController@head']);
    $app->addRoute('GET', $providerBaseRoute, ['as' => 'getProviderObject', 'uses' => 'Providers\ObjectController@get']);
});

$app->group(['namespace' => 'CHMS\ProviderHub\Http\Controllers', 'middleware' => $primaryMiddleware], function ($app) use ($providerBaseRoute) {

    /**
     * Path: /provider
     */
    $app->addRoute('POST', '/providers', ['as' => 'postProviders', 'uses' => 'Providers\IndexController@post']);


    /**
     * Path: /providers/{providerId}
     */
    $app->addRoute('PATCH', $providerBaseRoute, ['as' => 'patchProviderObject', 'uses' => 'Providers\ObjectController@patch']);
    $app->addRoute('DELETE', $providerBaseRoute, ['as' => 'deleteProviderObject', 'uses' => 'Providers\ObjectController@delete']);
});

$app->group(['namespace' => 'CHMS\ProviderHub\Http\Controllers', 'middleware' => array_merge(['prepare-context'], $clientMiddleware)], function ($app) use ($providerBaseRoute) {

    /**
     * Path: /providers/{providerId}/classes/{classId}/evaluationResponses
     */
    $app->addRoute('POST', $providerBaseRoute . '/classes/{classId}/evaluationResponses', ['as' => 'postEvaluationResponse', 'uses' => 'Classes\EvaluationController@post']);
});


$app->group(['namespace' => 'CHMS\ProviderHub\Http\Controllers', 'middleware' => array_merge(['prepare-context'], $mixMiddleware)], function ($app) use ($providerBaseRoute) {
    /**
     * Path: /providers/{providerId}/classes/{classId}
     */
    $app->addRoute('HEAD', $providerBaseRoute . '/classes/{classId}', ['as' => 'headClassObject', 'uses' => 'Classes\ObjectController@head']);
    $app->addRoute('GET', $providerBaseRoute . '/classes/{classId}', ['as' => 'getClassObject', 'uses' => 'Classes\ObjectController@get']);

    /**
     * Path: /providers/{providerId}/classes/{classId}/meetings
     */
    $app->addRoute('GET', $providerBaseRoute . '/classes/{classId}/meetings', ['as' => 'getMeetings', 'uses' => 'Classes\MeetingController@get']);


    /**
     * Path: /providers/{providerId}/classes/{classId}/meetings/{meetingId}
     */
    $app->addRoute('HEAD', $providerBaseRoute . '/classes/{classId}/meetings/{meetingId}', ['as' => 'headMeetingObject', 'uses' => 'Classes\MeetingController@headObject']);
    $app->addRoute('GET', $providerBaseRoute . '/classes/{classId}/meetings/{meetingId}', ['as' => 'getMeetingObject', 'uses' => 'Classes\MeetingController@getObject']);

    /**
     * Path: /providers/{providerId}/classes/{classId}/instructors
     */
    $app->addRoute('GET', $providerBaseRoute . '/classes/{classId}/instructors', ['as' => 'getClassInstructors', 'uses' => 'Classes\InstructorController@get']);
    $app->addRoute('POST', $providerBaseRoute . '/classes/{classId}/instructors', ['as' => 'postClassInstructors', 'uses' => 'Classes\InstructorController@post']);

    /**
     * Path: /providers/{providerId}/classes/{classId}/topics
     */
    $app->addRoute('GET', $providerBaseRoute . '/classes/{classId}/topics', ['as' => 'getClassTopics', 'uses' => 'Classes\TopicController@get']);

    /**
     * Path: /providers/{providerId}/classes/{classId}/evaluationResponses
     */
    $app->addRoute('GET', $providerBaseRoute . '/classes/{classId}/evaluationResponses', ['as' => 'getEvaluationResponses', 'uses' => 'Classes\EvaluationController@get']);

    /**
     * Path: /providers/{providerId}/evaluations
     */
    $app->addRoute('GET', $providerBaseRoute . '/evaluations', ['as' => 'getEvaluations', 'uses' => 'Evaluations\IndexController@get']);

    /**
     * Path: /providers/{providerId}/evaluations/{evaluationId}/questions
     */
    $app->addRoute('GET', $providerBaseRoute . '/evaluations/{evaluationId}/questions', ['as' => 'getQuestions', 'uses' => 'Evaluations\QuestionController@get']);


    /**
     * Path: /providers/{providerId}/records
     */
    $app->addRoute('GET', $providerBaseRoute . '/records',     ['as' => 'getRecords', 'uses' => 'Records\IndexController@get']);

    /**
     * Path: /providers/{providerId}/roles
     */
    $app->addRoute('GET', $providerBaseRoute . '/roles',     ['as' => 'getRoles', 'uses' => 'Roles\IndexController@get']);

    /**
     * Path: /providers/{providerId}/roles/{roleId}
     */
    $app->addRoute('HEAD', $providerBaseRoute . '/roles/{roleId}', ['as' => 'headRoleObject', 'uses' => 'Roles\ObjectController@head']);
    $app->addRoute('GET', $providerBaseRoute . '/roles/{roleId}',    ['as' => 'getRoleObject', 'uses' => 'Roles\ObjectController@get']);

});

$app->group(['namespace' => 'CHMS\ProviderHub\Http\Controllers', 'middleware' => array_merge(['prepare-context'], $primaryMiddleware)], function ($app) use ($providerBaseRoute) {
    /**
     * Path: /providers/{providerId}/classes
     */
    $app->addRoute('GET', $providerBaseRoute . '/classes', ['as' => 'getClasses', 'uses' => 'Classes\IndexController@get']);
    $app->addRoute('POST', $providerBaseRoute . '/classes', ['as' => 'postClasses', 'uses' => 'Classes\IndexController@post']);

    /**
     * Path: /providers/{providerId}/classes/{classId}
     */
    $app->addRoute('PATCH', $providerBaseRoute . '/classes/{classId}', ['as' => 'patchClassObject', 'uses' => 'Classes\ObjectController@patch']);
    $app->addRoute('DELETE', $providerBaseRoute . '/classes/{classId}', ['as' => 'deleteClassObject', 'uses' => 'Classes\ObjectController@delete']);

    /**
     * Path: /providers/{providerId}/classes/{classId}/meetings
     */
    $app->addRoute('POST', $providerBaseRoute . '/classes/{classId}/meetings', ['as' => 'postMeetings', 'uses' => 'Classes\MeetingController@post']);

    /**
     * Path: /providers/{providerId}/classes/{classId}/meetings/{meetingId}
     */
    $app->addRoute('PATCH', $providerBaseRoute . '/classes/{classId}/meetings/{meetingId}', ['as' => 'patchMeetingObject', 'uses' => 'Classes\MeetingController@patchObject']);
    $app->addRoute('DELETE', $providerBaseRoute . '/classes/{classId}/meetings/{meetingId}', ['as' => 'deleteMeetingObject', 'uses' => 'Classes\MeetingController@deleteObject']);

    /**
     * Path: /providers/{providerId}/classes/{classId}/instructors/{instructorId}
     */
    $app->addRoute('HEAD', $providerBaseRoute . '/classes/{classId}/instructors/{instructorId}', ['as' => 'headClassInstructor', 'uses' => 'Classes\InstructorController@headRelationship']);
    $app->addRoute('PUT', $providerBaseRoute . '/classes/{classId}/instructors/{instructorId}', ['as' => 'getClassInstructor', 'uses' => 'Classes\InstructorController@getRelationship']);
    $app->addRoute('DELETE', $providerBaseRoute . '/classes/{classId}/instructors/{instructorId}', ['as' => 'deleteClassInstructor', 'uses' => 'Classes\InstructorController@deleteRelationship']);

    /**
     * Path: /providers/{providerId}/classes/{classId}/topics/{topic}
     */
    $app->addRoute('HEAD', $providerBaseRoute . '/classes/{classId}/topics/{topic}', ['as' => 'headClassTopic', 'uses' => 'Classes\TopicController@headRelationship']);
    $app->addRoute('PUT', $providerBaseRoute . '/classes/{classId}/topics/{topic}', ['as' => 'getClassTopic', 'uses' => 'Classes\TopicController@getRelationship']);
    $app->addRoute('DELETE', $providerBaseRoute . '/classes/{classId}/topics/{topic}', ['as' => 'deleteClassTopic', 'uses' => 'Classes\TopicController@deleteRelationship']);

    /**
     * Path: /providers/{providerId}/classes/{classId}/records
     */
    $app->addRoute('GET', $providerBaseRoute . '/classes/{classId}/records', ['as' => 'getClassClockHourRecords', 'uses' => 'Classes\RecordController@get']);
    /**
     * Path: /providers/{providerId}/locations
     */
    $app->addRoute('GET', $providerBaseRoute . '/locations', ['as' => 'getLocations', 'uses' => 'Locations\IndexController@get']);
    $app->addRoute('POST', $providerBaseRoute . '/locations', ['as' => 'postLocations', 'uses' => 'Locations\IndexController@post']);

    /**
     * Path: /providers/{providerId}/locations/{locationId}
     */
    $app->addRoute('HEAD', $providerBaseRoute . '/locations/{locationId}', ['as' => 'headLocationObject', 'uses' => 'Locations\ObjectController@head']);
    $app->addRoute('GET', $providerBaseRoute . '/locations/{locationId}', ['as' => 'getLocationObject', 'uses' => 'Locations\ObjectController@get']);
    $app->addRoute('PATCH', $providerBaseRoute . '/locations/{locationId}', ['as' => 'patchLocationObject', 'uses' => 'Locations\ObjectController@patch']);
    $app->addRoute('DELETE', $providerBaseRoute . '/locations/{locationId}', ['as' => 'deleteLocationObject', 'uses' => 'Locations\ObjectController@delete']);


    /**
     * Path: /providers/{providerId}/topics
     */
    $app->addRoute('GET', $providerBaseRoute . '/topics', ['as' => 'getTopics', 'uses' => 'Topics\IndexController@get']);
    $app->addRoute('POST', $providerBaseRoute . '/topics', ['as' => 'postTopics', 'uses' => 'Topics\IndexController@post']);

    /**
     * Path: /providers/{providerId}/topics/{topicId}
     */
    $app->addRoute('HEAD', $providerBaseRoute . '/topics/{topicId}', ['as' => 'headTopicObject', 'uses' => 'Topics\ObjectController@head']);
    $app->addRoute('GET', $providerBaseRoute . '/topics/{topicId}', ['as' => 'getTopicObject', 'uses' => 'Topics\ObjectController@get']);
    $app->addRoute('PATCH', $providerBaseRoute . '/topics/{topicId}', ['as' => 'patchTopicObject', 'uses' => 'Topics\ObjectController@patch']);
    $app->addRoute('DELETE', $providerBaseRoute . '/topics/{topicId}', ['as' => 'deleteTopicObject', 'uses' => 'Topics\ObjectController@delete']);


    /**
     * Path: /providers/{providerId}/evaluations
     */
    $app->addRoute('POST', $providerBaseRoute . '/evaluations', ['as' => 'postEvaluations', 'uses' => 'Evaluations\IndexController@post']);

    /**
     * Path: /providers/{providerId}/evaluations/{evaluationId}
     */
    $app->addRoute('HEAD', $providerBaseRoute . '/evaluations/{evaluationId}', ['as' => 'headEvaluationObject', 'uses' => 'Evaluations\ObjectController@head']);
    $app->addRoute('GET', $providerBaseRoute . '/evaluations/{evaluationId}', ['as' => 'getEvaluationObject', 'uses' => 'Evaluations\ObjectController@get']);
    $app->addRoute('PATCH', $providerBaseRoute . '/evaluations/{evaluationId}', ['as' => 'patchEvaluationObject', 'uses' => 'Evaluations\ObjectController@patch']);
    $app->addRoute('DELETE', $providerBaseRoute . '/evaluations/{evaluationId}', ['as' => 'deleteEvaluationObject', 'uses' => 'Evaluations\ObjectController@delete']);

    /**
     * Path: /providers/{providerId}/records
     */
    $app->addRoute('POST', $providerBaseRoute . '/records', ['as' => 'postRecords', 'uses' => 'Records\IndexController@post']);

    /**
     * Path: /providers/{providerId}/records/{recordId}
     */
    $app->addRoute('HEAD', $providerBaseRoute . '/records/{recordId}', ['as' => 'headRecordObject', 'uses' => 'Records\ObjectController@head']);
    $app->addRoute('GET', $providerBaseRoute . '/records/{recordId}', ['as' => 'getRecordObject', 'uses' => 'Records\ObjectController@get']);
    $app->addRoute('PATCH', $providerBaseRoute . '/records/{recordId}', ['as' => 'patchRecordObject', 'uses' => 'Records\ObjectController@patch']);
    $app->addRoute('DELETE', $providerBaseRoute . '/records/{recordId}', ['as' => 'deleteRecordObject', 'uses' => 'Records\ObjectController@delete']);


    /**
     * Path: /providers/{providerId}/evaluations/{evaluationId}/questions
     */
    $app->addRoute('POST', $providerBaseRoute . '/evaluations/{evaluationId}/questions', ['as' => 'postQuestion', 'uses' => 'Evaluations\QuestionController@post']);

    /**
     * Path: /providers/{providerId}/evaluations/{evaluationId}/questions/{questionId}
     */
    $app->addRoute('HEAD', $providerBaseRoute . '/evaluations/{evaluationId}/questions/{questionId}', ['as' => 'headQuestionObject', 'uses' => 'Evaluations\QuestionController@headObject']);
    $app->addRoute('GET', $providerBaseRoute . '/evaluations/{evaluationId}/questions/{questionId}', ['as' => 'getQuestionObject', 'uses' => 'Evaluations\QuestionController@getObject']);
    $app->addRoute('PATCH', $providerBaseRoute . '/evaluations/{evaluationId}/questions/{questionId}', ['as' => 'patchQuestionObject', 'uses' => 'Evaluations\QuestionController@patchObject']);
    $app->addRoute('DELETE', $providerBaseRoute . '/evaluations/{evaluationId}/questions/{questionId}', ['as' => 'deleteQuestionObject', 'uses' => 'Evaluations\QuestionController@deleteObject']);
});
