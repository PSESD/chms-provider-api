<?php
/**
 * Clock Hour Management System - Sponsor Provider
 *
 * @copyright Copyright (c) 2016 Puget Sound Educational Service District
 * @license   Proprietary
 */

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Illuminate\Http\Response;
use CHMS\SponsorProvider\Repositories\Contracts\RoleRepository;

/**
 * Path: /sponsors/{sponsorId}/
 */
$app->addRoute('GET', '/', function () use ($app) {
    //\dump($sponsor);
    return ['okay'];
});


/**
 * Path: /sponsors/{sponsorId}/version
 */
$app->addRoute('GET', '/version', function () use ($app) {
    return ['version' => $app->version()];
});

$primaryMiddleware = ['auth:user', 'auth-route']; // ['oauth', 'oauth-user', 'auth:user', 'auth-route'];
$clientMiddleware = ['auth:client', 'auth-route']; // ['oauth', 'oauth-client', 'auth:client', 'auth-route'];
$mixMiddleware = ['auth:*', 'auth-route']; // ['oauth', 'auth:*', 'auth-route'];
$sponsorBaseRoute = '/sponsors/{sponsorId}';

$app->group(['namespace' => 'CHMS\SponsorProvider\Http\Controllers', 'middleware' => $mixMiddleware], function ($app) use ($sponsorBaseRoute) {

    /**
     * Path: /sponsor
     */
    $app->addRoute('GET', '/sponsors', ['as' => 'getSponsors', 'uses' => 'Sponsors\IndexController@get']);


    /**
     * Path: /sponsors/{sponsorId}
     */
    $app->addRoute('HEAD', $sponsorBaseRoute, ['as' => 'headSponsorObject', 'uses' => 'Sponsors\ObjectController@head']);
    $app->addRoute('GET', $sponsorBaseRoute, ['as' => 'getSponsorObject', 'uses' => 'Sponsors\ObjectController@get']);
});

$app->group(['namespace' => 'CHMS\SponsorProvider\Http\Controllers', 'middleware' => $primaryMiddleware], function ($app) use ($sponsorBaseRoute) {

    /**
     * Path: /sponsor
     */
    $app->addRoute('POST', '/sponsors', ['as' => 'postSponsors', 'uses' => 'Sponsors\IndexController@post']);


    /**
     * Path: /sponsors/{sponsorId}
     */
    $app->addRoute('PATCH', $sponsorBaseRoute, ['as' => 'patchSponsorObject', 'uses' => 'Sponsors\ObjectController@patch']);
    $app->addRoute('DELETE', $sponsorBaseRoute, ['as' => 'deleteSponsorObject', 'uses' => 'Sponsors\ObjectController@delete']);
});

$app->group(['namespace' => 'CHMS\SponsorProvider\Http\Controllers', 'middleware' => array_merge(['prepare-context'], $clientMiddleware)], function ($app) use ($sponsorBaseRoute) {

    /**
     * Path: /sponsors/{sponsorId}/classes/{classId}/evaluationResponses
     */
    $app->addRoute('POST', $sponsorBaseRoute . '/classes/{classId}/evaluationResponses', ['as' => 'postEvaluationResponse', 'uses' => 'Classes\EvaluationController@post']);
});


$app->group(['namespace' => 'CHMS\SponsorProvider\Http\Controllers', 'middleware' => array_merge(['prepare-context'], $mixMiddleware)], function ($app) use ($sponsorBaseRoute) {
    /**
     * Path: /sponsors/{sponsorId}/classes/{classId}
     */
    $app->addRoute('HEAD', $sponsorBaseRoute . '/classes/{classId}', ['as' => 'headClassObject', 'uses' => 'Classes\ObjectController@head']);
    $app->addRoute('GET', $sponsorBaseRoute . '/classes/{classId}', ['as' => 'getClassObject', 'uses' => 'Classes\ObjectController@get']);

    /**
     * Path: /sponsors/{sponsorId}/classes/{classId}/meetings
     */
    $app->addRoute('GET', $sponsorBaseRoute . '/classes/{classId}/meetings', ['as' => 'getMeetings', 'uses' => 'Classes\MeetingController@get']);


    /**
     * Path: /sponsors/{sponsorId}/classes/{classId}/meetings/{meetingId}
     */
    $app->addRoute('HEAD', $sponsorBaseRoute . '/classes/{classId}/meetings/{meetingId}', ['as' => 'headMeetingObject', 'uses' => 'Classes\MeetingController@headObject']);
    $app->addRoute('GET', $sponsorBaseRoute . '/classes/{classId}/meetings/{meetingId}', ['as' => 'getMeetingObject', 'uses' => 'Classes\MeetingController@getObject']);

    /**
     * Path: /sponsors/{sponsorId}/classes/{classId}/instructors
     */
    $app->addRoute('GET', $sponsorBaseRoute . '/classes/{classId}/instructors', ['as' => 'getClassInstructors', 'uses' => 'Classes\InstructorController@get']);
    $app->addRoute('POST', $sponsorBaseRoute . '/classes/{classId}/instructors', ['as' => 'postClassInstructors', 'uses' => 'Classes\InstructorController@post']);

    /**
     * Path: /sponsors/{sponsorId}/classes/{classId}/topics
     */
    $app->addRoute('GET', $sponsorBaseRoute . '/classes/{classId}/topics', ['as' => 'getClassTopics', 'uses' => 'Classes\TopicController@get']);

    /**
     * Path: /sponsors/{sponsorId}/classes/{classId}/evaluationResponses
     */
    $app->addRoute('GET', $sponsorBaseRoute . '/classes/{classId}/evaluationResponses', ['as' => 'getEvaluationResponses', 'uses' => 'Classes\EvaluationController@get']);

    /**
     * Path: /sponsors/{sponsorId}/evaluations
     */
    $app->addRoute('GET', $sponsorBaseRoute . '/evaluations', ['as' => 'getEvaluations', 'uses' => 'Evaluations\IndexController@get']);

    /**
     * Path: /sponsors/{sponsorId}/evaluations/{evaluationId}/questions
     */
    $app->addRoute('GET', $sponsorBaseRoute . '/evaluations/{evaluationId}/questions', ['as' => 'getQuestions', 'uses' => 'Evaluations\QuestionController@get']);


    /**
     * Path: /sponsors/{sponsorId}/records
     */
    $app->addRoute('GET', $sponsorBaseRoute . '/records',     ['as' => 'getRecords', 'uses' => 'Records\IndexController@get']);

    /**
     * Path: /sponsors/{sponsorId}/roles
     */
    $app->addRoute('GET', $sponsorBaseRoute . '/roles',     ['as' => 'getRoles', 'uses' => 'Roles\IndexController@get']);

    /**
     * Path: /sponsors/{sponsorId}/roles/{roleId}
     */
    $app->addRoute('HEAD', $sponsorBaseRoute . '/roles/{roleId}', ['as' => 'headRoleObject', 'uses' => 'Roles\ObjectController@head']);
    $app->addRoute('GET', $sponsorBaseRoute . '/roles/{roleId}',    ['as' => 'getRoleObject', 'uses' => 'Roles\ObjectController@get']);

});

$app->group(['namespace' => 'CHMS\SponsorProvider\Http\Controllers', 'middleware' => array_merge(['prepare-context'], $primaryMiddleware)], function ($app) use ($sponsorBaseRoute) {
    /**
     * Path: /sponsors/{sponsorId}/classes
     */
    $app->addRoute('GET', $sponsorBaseRoute . '/classes', ['as' => 'getClasses', 'uses' => 'Classes\IndexController@get']);
    $app->addRoute('POST', $sponsorBaseRoute . '/classes', ['as' => 'postClasses', 'uses' => 'Classes\IndexController@post']);

    /**
     * Path: /sponsors/{sponsorId}/classes/{classId}
     */
    $app->addRoute('PATCH', $sponsorBaseRoute . '/classes/{classId}', ['as' => 'patchClassObject', 'uses' => 'Classes\ObjectController@patch']);
    $app->addRoute('DELETE', $sponsorBaseRoute . '/classes/{classId}', ['as' => 'deleteClassObject', 'uses' => 'Classes\ObjectController@delete']);

    /**
     * Path: /sponsors/{sponsorId}/classes/{classId}/meetings
     */
    $app->addRoute('POST', $sponsorBaseRoute . '/classes/{classId}/meetings', ['as' => 'postMeetings', 'uses' => 'Classes\MeetingController@post']);

    /**
     * Path: /sponsors/{sponsorId}/classes/{classId}/meetings/{meetingId}
     */
    $app->addRoute('PATCH', $sponsorBaseRoute . '/classes/{classId}/meetings/{meetingId}', ['as' => 'patchMeetingObject', 'uses' => 'Classes\MeetingController@patchObject']);
    $app->addRoute('DELETE', $sponsorBaseRoute . '/classes/{classId}/meetings/{meetingId}', ['as' => 'deleteMeetingObject', 'uses' => 'Classes\MeetingController@deleteObject']);

    /**
     * Path: /sponsors/{sponsorId}/classes/{classId}/instructors/{instructorId}
     */
    $app->addRoute('HEAD', $sponsorBaseRoute . '/classes/{classId}/instructors/{instructorId}', ['as' => 'headClassInstructor', 'uses' => 'Classes\InstructorController@headRelationship']);
    $app->addRoute('PUT', $sponsorBaseRoute . '/classes/{classId}/instructors/{instructorId}', ['as' => 'getClassInstructor', 'uses' => 'Classes\InstructorController@getRelationship']);
    $app->addRoute('DELETE', $sponsorBaseRoute . '/classes/{classId}/instructors/{instructorId}', ['as' => 'deleteClassInstructor', 'uses' => 'Classes\InstructorController@deleteRelationship']);

    /**
     * Path: /sponsors/{sponsorId}/classes/{classId}/topics/{topic}
     */
    $app->addRoute('HEAD', $sponsorBaseRoute . '/classes/{classId}/topics/{topic}', ['as' => 'headClassTopic', 'uses' => 'Classes\TopicController@headRelationship']);
    $app->addRoute('PUT', $sponsorBaseRoute . '/classes/{classId}/topics/{topic}', ['as' => 'getClassTopic', 'uses' => 'Classes\TopicController@getRelationship']);
    $app->addRoute('DELETE', $sponsorBaseRoute . '/classes/{classId}/topics/{topic}', ['as' => 'deleteClassTopic', 'uses' => 'Classes\TopicController@deleteRelationship']);

    /**
     * Path: /sponsors/{sponsorId}/classes/{classId}/records
     */
    $app->addRoute('GET', $sponsorBaseRoute . '/classes/{classId}/records', ['as' => 'getClassClockHourRecords', 'uses' => 'Classes\RecordController@get']);
    /**
     * Path: /sponsors/{sponsorId}/locations
     */
    $app->addRoute('GET', $sponsorBaseRoute . '/locations', ['as' => 'getLocations', 'uses' => 'Locations\IndexController@get']);
    $app->addRoute('POST', $sponsorBaseRoute . '/locations', ['as' => 'postLocations', 'uses' => 'Locations\IndexController@post']);

    /**
     * Path: /sponsors/{sponsorId}/locations/{locationId}
     */
    $app->addRoute('HEAD', $sponsorBaseRoute . '/locations/{locationId}', ['as' => 'headLocationObject', 'uses' => 'Locations\ObjectController@head']);
    $app->addRoute('GET', $sponsorBaseRoute . '/locations/{locationId}', ['as' => 'getLocationObject', 'uses' => 'Locations\ObjectController@get']);
    $app->addRoute('PATCH', $sponsorBaseRoute . '/locations/{locationId}', ['as' => 'patchLocationObject', 'uses' => 'Locations\ObjectController@patch']);
    $app->addRoute('DELETE', $sponsorBaseRoute . '/locations/{locationId}', ['as' => 'deleteLocationObject', 'uses' => 'Locations\ObjectController@delete']);


    /**
     * Path: /sponsors/{sponsorId}/topics
     */
    $app->addRoute('GET', $sponsorBaseRoute . '/topics', ['as' => 'getTopics', 'uses' => 'Topics\IndexController@get']);
    $app->addRoute('POST', $sponsorBaseRoute . '/topics', ['as' => 'postTopics', 'uses' => 'Topics\IndexController@post']);

    /**
     * Path: /sponsors/{sponsorId}/topics/{topicId}
     */
    $app->addRoute('HEAD', $sponsorBaseRoute . '/topics/{topicId}', ['as' => 'headTopicObject', 'uses' => 'Topics\ObjectController@head']);
    $app->addRoute('GET', $sponsorBaseRoute . '/topics/{topicId}', ['as' => 'getTopicObject', 'uses' => 'Topics\ObjectController@get']);
    $app->addRoute('PATCH', $sponsorBaseRoute . '/topics/{topicId}', ['as' => 'patchTopicObject', 'uses' => 'Topics\ObjectController@patch']);
    $app->addRoute('DELETE', $sponsorBaseRoute . '/topics/{topicId}', ['as' => 'deleteTopicObject', 'uses' => 'Topics\ObjectController@delete']);


    /**
     * Path: /sponsors/{sponsorId}/evaluations
     */
    $app->addRoute('POST', $sponsorBaseRoute . '/evaluations', ['as' => 'postEvaluations', 'uses' => 'Evaluations\IndexController@post']);

    /**
     * Path: /sponsors/{sponsorId}/evaluations/{evaluationId}
     */
    $app->addRoute('HEAD', $sponsorBaseRoute . '/evaluations/{evaluationId}', ['as' => 'headEvaluationObject', 'uses' => 'Evaluations\ObjectController@head']);
    $app->addRoute('GET', $sponsorBaseRoute . '/evaluations/{evaluationId}', ['as' => 'getEvaluationObject', 'uses' => 'Evaluations\ObjectController@get']);
    $app->addRoute('PATCH', $sponsorBaseRoute . '/evaluations/{evaluationId}', ['as' => 'patchEvaluationObject', 'uses' => 'Evaluations\ObjectController@patch']);
    $app->addRoute('DELETE', $sponsorBaseRoute . '/evaluations/{evaluationId}', ['as' => 'deleteEvaluationObject', 'uses' => 'Evaluations\ObjectController@delete']);

    /**
     * Path: /sponsors/{sponsorId}/records
     */
    $app->addRoute('POST', $sponsorBaseRoute . '/records', ['as' => 'postRecords', 'uses' => 'Records\IndexController@post']);

    /**
     * Path: /sponsors/{sponsorId}/records/{recordId}
     */
    $app->addRoute('HEAD', $sponsorBaseRoute . '/records/{recordId}', ['as' => 'headRecordObject', 'uses' => 'Records\ObjectController@head']);
    $app->addRoute('GET', $sponsorBaseRoute . '/records/{recordId}', ['as' => 'getRecordObject', 'uses' => 'Records\ObjectController@get']);
    $app->addRoute('PATCH', $sponsorBaseRoute . '/records/{recordId}', ['as' => 'patchRecordObject', 'uses' => 'Records\ObjectController@patch']);
    $app->addRoute('DELETE', $sponsorBaseRoute . '/records/{recordId}', ['as' => 'deleteRecordObject', 'uses' => 'Records\ObjectController@delete']);


    /**
     * Path: /sponsors/{sponsorId}/evaluations/{evaluationId}/questions
     */
    $app->addRoute('POST', $sponsorBaseRoute . '/evaluations/{evaluationId}/questions', ['as' => 'postQuestion', 'uses' => 'Evaluations\QuestionController@post']);

    /**
     * Path: /sponsors/{sponsorId}/evaluations/{evaluationId}/questions/{questionId}
     */
    $app->addRoute('HEAD', $sponsorBaseRoute . '/evaluations/{evaluationId}/questions/{questionId}', ['as' => 'headQuestionObject', 'uses' => 'Evaluations\QuestionController@headObject']);
    $app->addRoute('GET', $sponsorBaseRoute . '/evaluations/{evaluationId}/questions/{questionId}', ['as' => 'getQuestionObject', 'uses' => 'Evaluations\QuestionController@getObject']);
    $app->addRoute('PATCH', $sponsorBaseRoute . '/evaluations/{evaluationId}/questions/{questionId}', ['as' => 'patchQuestionObject', 'uses' => 'Evaluations\QuestionController@patchObject']);
    $app->addRoute('DELETE', $sponsorBaseRoute . '/evaluations/{evaluationId}/questions/{questionId}', ['as' => 'deleteQuestionObject', 'uses' => 'Evaluations\QuestionController@deleteObject']);
});
