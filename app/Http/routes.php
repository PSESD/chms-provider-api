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
 * Path: /
 */
$app->addRoute('GET', '/', function () use ($app) {
    //\dump($provider);
    return ['okay'];
});


/**
 * Path: /version
 */
$app->addRoute('GET', '/version', function () use ($app) {
    return ['version' => $app->version()];
});

$primaryMiddleware = ['oauth', 'oauth-user', 'auth:user', 'auth-route'];
$clientMiddleware = ['oauth', 'oauth-client', 'auth:client', 'auth-route'];
$mixMiddleware = ['oauth', 'auth:*', 'auth-route'];



$app->group(['namespace' => 'CHMS\Provider\Http\Controllers', 'middleware' => $mixMiddleware], function ($app) {
    /**
     * Path: /classes/{classId}
     */
    $app->addRoute('HEAD', '/classes/{classId}', ['as' => 'headClassObject', 'uses' => 'Classes\ObjectController@head']);
    $app->addRoute('GET', '/classes/{classId}', ['as' => 'getClassObject', 'uses' => 'Classes\ObjectController@get']);

    /**
     * Path: /classes/{classId}/meetings
     */
    $app->addRoute('GET', '/classes/{classId}/meetings', ['as' => 'getMeetings', 'uses' => 'Classes\MeetingController@get']);


    /**
     * Path: /classes/{classId}/meetings/{meetingId}
     */
    $app->addRoute('HEAD', '/classes/{classId}/meetings/{meetingId}', ['as' => 'headMeetingObject', 'uses' => 'Classes\MeetingController@headObject']);
    $app->addRoute('GET', '/classes/{classId}/meetings/{meetingId}', ['as' => 'getMeetingObject', 'uses' => 'Classes\MeetingController@getObject']);

    /**
     * Path: /classes/{classId}/instructors
     */
    $app->addRoute('GET', '/classes/{classId}/instructors', ['as' => 'getClassInstructors', 'uses' => 'Classes\InstructorController@get']);
    $app->addRoute('POST', '/classes/{classId}/instructors', ['as' => 'postClassInstructors', 'uses' => 'Classes\InstructorController@post']);

    /**
     * Path: /classes/{classId}/topics
     */
    $app->addRoute('GET', '/classes/{classId}/topics', ['as' => 'getClassTopics', 'uses' => 'Classes\TopicController@get']);

    /**
     * Path: /classes/{classId}/evaluationResponses
     */
    $app->addRoute('GET', '/classes/{classId}/evaluationResponses', ['as' => 'getEvaluationResponses', 'uses' => 'Classes\EvaluationController@get']);

    /**
     * Path: /evaluations
     */
    $app->addRoute('GET', '/evaluations', ['as' => 'getEvaluations', 'uses' => 'Evaluations\IndexController@get']);

    /**
     * Path: /evaluations/{evaluationId}/questions
     */
    $app->addRoute('GET', '/evaluations/{evaluationId}/questions', ['as' => 'getQuestions', 'uses' => 'Evaluations\QuestionController@get']);


    /**
     * Path: /records
     */
    $app->addRoute('GET', '/records',     ['as' => 'getRecords', 'uses' => 'Records\IndexController@get']);

    /**
     * Path: /roles
     */
    $app->addRoute('GET', '/roles',     ['as' => 'getRoles', 'uses' => 'Roles\IndexController@get']);

    /**
     * Path: /roles/{roleId}
     */
    $app->addRoute('HEAD', '/roles/{roleId}', ['as' => 'headRoleObject', 'uses' => 'Roles\ObjectController@head']);
    $app->addRoute('GET', '/roles/{roleId}',    ['as' => 'getRoleObject', 'uses' => 'Roles\ObjectController@get']);

});

$app->group(['namespace' => 'CHMS\Provider\Http\Controllers', 'middleware' => $clientMiddleware], function ($app) {

    /**
     * Path: /classes/{classId}/evaluationResponses
     */
    $app->addRoute('POST', '/classes/{classId}/evaluationResponses', ['as' => 'postEvaluationResponse', 'uses' => 'Classes\EvaluationController@post']);
});

$app->group(['namespace' => 'CHMS\Provider\Http\Controllers', 'middleware' => $primaryMiddleware], function ($app) {
    /**
     * Path: /classes
     */
    $app->addRoute('GET', '/classes', ['as' => 'getClasses', 'uses' => 'Classes\IndexController@get']);
    $app->addRoute('POST', '/classes', ['as' => 'postClasses', 'uses' => 'Classes\IndexController@post']);

    /**
     * Path: /classes/{classId}
     */
    $app->addRoute('PATCH', '/classes/{classId}', ['as' => 'patchClassObject', 'uses' => 'Classes\ObjectController@patch']);
    $app->addRoute('DELETE', '/classes/{classId}', ['as' => 'deleteClassObject', 'uses' => 'Classes\ObjectController@delete']);

    /**
     * Path: /classes/{classId}/meetings
     */
    $app->addRoute('POST', '/classes/{classId}/meetings', ['as' => 'postMeetings', 'uses' => 'Classes\MeetingController@post']);

    /**
     * Path: /classes/{classId}/meetings/{meetingId}
     */
    $app->addRoute('PATCH', '/classes/{classId}/meetings/{meetingId}', ['as' => 'patchMeetingObject', 'uses' => 'Classes\MeetingController@patchObject']);
    $app->addRoute('DELETE', '/classes/{classId}/meetings/{meetingId}', ['as' => 'deleteMeetingObject', 'uses' => 'Classes\MeetingController@deleteObject']);

    /**
     * Path: /classes/{classId}/instructors/{instructorId}
     */
    $app->addRoute('HEAD', '/classes/{classId}/instructors/{instructorId}', ['as' => 'headClassInstructor', 'uses' => 'Classes\InstructorController@headRelationship']);
    $app->addRoute('PUT', '/classes/{classId}/instructors/{instructorId}', ['as' => 'getClassInstructor', 'uses' => 'Classes\InstructorController@getRelationship']);
    $app->addRoute('DELETE', '/classes/{classId}/instructors/{instructorId}', ['as' => 'deleteClassInstructor', 'uses' => 'Classes\InstructorController@deleteRelationship']);

    /**
     * Path: /classes/{classId}/topics/{topic}
     */
    $app->addRoute('HEAD', '/classes/{classId}/topics/{topic}', ['as' => 'headClassTopic', 'uses' => 'Classes\TopicController@headRelationship']);
    $app->addRoute('PUT', '/classes/{classId}/topics/{topic}', ['as' => 'getClassTopic', 'uses' => 'Classes\TopicController@getRelationship']);
    $app->addRoute('DELETE', '/classes/{classId}/topics/{topic}', ['as' => 'deleteClassTopic', 'uses' => 'Classes\TopicController@deleteRelationship']);

    /**
     * Path: /classes/{classId}/records
     */
    $app->addRoute('GET', '/classes/{classId}/records', ['as' => 'getClassClockHourRecords', 'uses' => 'Classes\RecordController@get']);
    /**
     * Path: /locations
     */
    $app->addRoute('GET', '/locations', ['as' => 'getLocations', 'uses' => 'Locations\IndexController@get']);
    $app->addRoute('POST', '/locations', ['as' => 'postLocations', 'uses' => 'Locations\IndexController@post']);

    /**
     * Path: /locations/{locationId}
     */
    $app->addRoute('HEAD', '/locations/{locationId}', ['as' => 'headLocationObject', 'uses' => 'Locations\ObjectController@head']);
    $app->addRoute('GET', '/locations/{locationId}', ['as' => 'getLocationObject', 'uses' => 'Locations\ObjectController@get']);
    $app->addRoute('PATCH', '/locations/{locationId}', ['as' => 'patchLocationObject', 'uses' => 'Locations\ObjectController@patch']);
    $app->addRoute('DELETE', '/locations/{locationId}', ['as' => 'deleteLocationObject', 'uses' => 'Locations\ObjectController@delete']);


    /**
     * Path: /topics
     */
    $app->addRoute('GET', '/topics', ['as' => 'getTopics', 'uses' => 'Topics\IndexController@get']);
    $app->addRoute('POST', '/topics', ['as' => 'postTopics', 'uses' => 'Topics\IndexController@post']);

    /**
     * Path: /topics/{topicId}
     */
    $app->addRoute('HEAD', '/topics/{topicId}', ['as' => 'headTopicObject', 'uses' => 'Topics\ObjectController@head']);
    $app->addRoute('GET', '/topics/{topicId}', ['as' => 'getTopicObject', 'uses' => 'Topics\ObjectController@get']);
    $app->addRoute('PATCH', '/topics/{topicId}', ['as' => 'patchTopicObject', 'uses' => 'Topics\ObjectController@patch']);
    $app->addRoute('DELETE', '/topics/{topicId}', ['as' => 'deleteTopicObject', 'uses' => 'Topics\ObjectController@delete']);


    /**
     * Path: /evaluations
     */
    $app->addRoute('POST', '/evaluations', ['as' => 'postEvaluations', 'uses' => 'Evaluations\IndexController@post']);

    /**
     * Path: /evaluations/{evaluationId}
     */
    $app->addRoute('HEAD', '/evaluations/{evaluationId}', ['as' => 'headEvaluationObject', 'uses' => 'Evaluations\ObjectController@head']);
    $app->addRoute('GET', '/evaluations/{evaluationId}', ['as' => 'getEvaluationObject', 'uses' => 'Evaluations\ObjectController@get']);
    $app->addRoute('PATCH', '/evaluations/{evaluationId}', ['as' => 'patchEvaluationObject', 'uses' => 'Evaluations\ObjectController@patch']);
    $app->addRoute('DELETE', '/evaluations/{evaluationId}', ['as' => 'deleteEvaluationObject', 'uses' => 'Evaluations\ObjectController@delete']);

    /**
     * Path: /records
     */
    $app->addRoute('POST', '/records', ['as' => 'postRecords', 'uses' => 'Records\IndexController@post']);

    /**
     * Path: /records/{recordId}
     */
    $app->addRoute('HEAD', '/records/{recordId}', ['as' => 'headRecordObject', 'uses' => 'Records\ObjectController@head']);
    $app->addRoute('GET', '/records/{recordId}', ['as' => 'getRecordObject', 'uses' => 'Records\ObjectController@get']);
    $app->addRoute('PATCH', '/records/{recordId}', ['as' => 'patchRecordObject', 'uses' => 'Records\ObjectController@patch']);
    $app->addRoute('DELETE', '/records/{recordId}', ['as' => 'deleteRecordObject', 'uses' => 'Records\ObjectController@delete']);


    /**
     * Path: /evaluations/{evaluationId}/questions
     */
    $app->addRoute('POST', '/evaluations/{evaluationId}/questions', ['as' => 'postQuestion', 'uses' => 'Evaluations\QuestionController@post']);

    /**
     * Path: /evaluations/{evaluationId}/questions/{questionId}
     */
    $app->addRoute('HEAD', '/evaluations/{evaluationId}/questions/{questionId}', ['as' => 'headQuestionObject', 'uses' => 'Evaluations\QuestionController@headObject']);
    $app->addRoute('GET', '/evaluations/{evaluationId}/questions/{questionId}', ['as' => 'getQuestionObject', 'uses' => 'Evaluations\QuestionController@getObject']);
    $app->addRoute('PATCH', '/evaluations/{evaluationId}/questions/{questionId}', ['as' => 'patchQuestionObject', 'uses' => 'Evaluations\QuestionController@patchObject']);
    $app->addRoute('DELETE', '/evaluations/{evaluationId}/questions/{questionId}', ['as' => 'deleteQuestionObject', 'uses' => 'Evaluations\QuestionController@deleteObject']);
});
