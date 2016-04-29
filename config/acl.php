<?php
use CHMS\SponsorProvider\Models\ClassMeeting as ClassMeetingModel;
use CHMS\SponsorProvider\Models\ClassRecord as ClassRecordModel;
use CHMS\SponsorProvider\Models\ClassTopic as ClassTopicModel;
use CHMS\SponsorProvider\Models\ClockHourRecord as ClockHourRecordModel;
use CHMS\SponsorProvider\Models\Evaluation as EvaluationModel;
use CHMS\SponsorProvider\Models\EvaluationQuestion as EvaluationQuestionModel;
use CHMS\SponsorProvider\Models\EvaluationQuestionOption as EvaluationQuestionOptionModel;
use CHMS\SponsorProvider\Models\Location as LocationModel;
use CHMS\SponsorProvider\Models\Organization as OrganizationModel;
use CHMS\SponsorProvider\Models\Role as RoleModel;
use CHMS\SponsorProvider\Models\RoleUser as RoleUserModel;
use CHMS\SponsorProvider\Models\Sponsor as SponsorModel;
use CHMS\SponsorProvider\Models\Topic as TopicModel;
use CHMS\SponsorProvider\Models\User as UserModel;


return [
    'roles' => [
        'super_administrator' => ['name' => 'Super Administrator', 'context' => 'hub', 'level' => 10],
        'hub_administrator' => ['name' => 'Hub Administrator', 'context' => 'hub', 'level' => 11],
        'sponsor_administrator' => ['name' => 'Sponsor Administrator', 'context' => 'sponsor', 'level' => 100],
        'sponsor_registrar' => ['name' => 'Sponsor Registrar', 'context' => 'sponsor', 'level' => 110],
        'sponsor_reviewer' => ['name' => 'Sponsor Reviewer', 'context' => 'sponsor', 'level' => 120],
        'class_creator' => ['name' => 'Class Creator', 'context' => 'class', 'level' => 300],
        'instructor' => ['name' => 'Instructor', 'context' => 'class', 'level' => 310],
        'student' => ['name' => 'Student', 'context' => 'sponsor', 'level' => 1000],

        'self' => ['name' => 'Self', 'level' => 2000, 'context' => 'sponsor', 'virtual' => true], // for accessing your own user record
        'guest' => ['name' => 'Guest', 'level' => 9999, 'context' => 'sponsor', 'virtual' => true],

        'client_hub' => ['name' => 'Hub Client', 'level' => 0, 'context' => 'client', 'virtual' => true]
    ],
    'globalRules' => [
        ['allow', 'roles' => 'sponsor_administrator', 'privileges' => null],
    ],
    'globalFieldRules' => [
        'id' => [
            'everyone' => ['read']
        ],
        'created_at' => [
            'everyone' => ['read']
        ],
        'updated_at' => [
            'everyone' => ['read']
        ],
        'deleted_at' => [
        ],
        'deleted_by' => [
        ]
    ],
    'ruleSets' => [
        // note: for route rules, no context is pulled first. For example, any rule that references 'instructor' would allow ANY instructor
        'everyone' => [
            ['allow', 'roles' => null],
            ['deny', 'roles' => 'guest']
        ],
        'role-sponsor-admins' => [
            ['allow', 'roles' => 'sponsor_administrator']
        ],
        'role-sponsor-privileged' => [
            ['allow', 'roles' => 'sponsor_administrator'],
            ['allow', 'roles' => 'sponsor_registrar'],
            ['allow', 'roles' => 'sponsor_reviewer'],
            ['allow', 'roles' => 'super_administrator'],
            ['allow', 'roles' => 'hub_administrator'],
        ],
        'role-class-privileged' => [
            ['allow', 'roles' => 'class_creator'],
            ['allow', 'roles' => 'instructor']
        ],
        'role-client-hub' => [
            ['allow', 'roles' => 'client_hub']
        ],
        'role-self' => [
            ['allow', 'roles' => ['self']]
        ]
    ],
    'modelRules' => [
        ClassMeetingModel::class => [
            'access' => [
                'role-sponsor-privileged' => ['read', 'set'],
                'role-class-privileged' => ['read', 'set'],
            ],
            'fields' => [
                '*' => true
            ]
        ],
        ClassRecordModel::class => [
            'access' => [
                'role-sponsor-privileged' => ['read', 'set'],
                'role-class-privileged' => ['read', 'set'],
            ],
            'fields' => [
                '*' => true
            ]
        ],
        ClassTopicModel::class => [
            'access' => [
                'role-sponsor-privileged' => ['read', 'set'],
                'role-class-privileged' => ['read', 'set'],
            ],
            'fields' => [
                '*' => true
            ]
        ],
        ClockHourRecordModel::class => [
            'access' => [
                'role-sponsor-privileged' => ['read', 'set'],
                'role-class-privileged' => ['read', 'set'],
            ],
            'fields' => [
                '*' => true
            ]
        ],
        EvaluationModel::class => [
            'access' => [
                'everyone' => ['read'],
                'role-sponsor-privileged' => ['read', 'set'],
            ],
            'fields' => [
                '*' => true
            ]
        ],
        EvaluationQuestionModel::class => [
            'access' => [
                'everyone' => ['read'],
                'role-sponsor-privileged' => ['read', 'set'],
            ],
            'fields' => [
                '*' => true
            ]
        ],
        EvaluationQuestionOptionModel::class => [
            'access' => [
                'everyone' => ['read'],
                'role-sponsor-privileged' => ['read', 'set'],
            ],
            'fields' => [
                '*' => true
            ]
        ],
        LocationModel::class => [
            'access' => [
                'everyone' => ['read'],
                'role-sponsor-privileged' => ['read', 'set'],
                'role-class-privileged' => ['read', 'set'],
            ],
            'fields' => [
                '*' => true
            ]
        ],
        TopicModel::class => [
            'access' => [
                'role-sponsor-privileged' => ['read', 'set'],
                'role-class-privileged' => ['read', 'set'],
            ],
            'fields' => [
                '*' => true
            ]
        ],
        RoleModel::class => [
            'access' => [
                'everyone' => ['read']
            ],
            'fields' => [
                '*' => true
            ]
        ],
        UserModel::class => [
            'access' => [
                'role-sponsor-privileged' => ['read', 'set'],
                'role-class-privileged' => ['read', 'set'],
            ],
            'fields' => [
                '*' => true
            ]
        ],
        OrganizationModel::class => [
            'access' => [
                'role-sponsor-privileged' => ['read', 'set'],
                'role-class-privileged' => ['read', 'set'],
            ],
            'fields' => [
                '*' => true
            ]
        ],
        SponsorModel::class => [
            'access' => [
                'role-sponsor-privileged' => ['read', 'set'],
                'role-class-privileged' => ['read', 'set'],
            ],
            'fields' => [
                '*' => true
            ]
        ],
    ],
    'routeRules' => [

        'getSponsors' => ['everyone'],
        'postSponsors' => ['everyone'],
        'headSponsorObject' => ['everyone'],
        'getSponsorObject' => ['everyone'],
        'patchSponsorObject' => ['everyone'],
        'deleteSponsorObject' => ['everyone'],

        'getClasses' => ['everyone'],
        'postClasses' => ['everyone'],
        'headClassObject' => ['everyone'],
        'getClassObject' => ['everyone'],
        'patchClassObject' => ['everyone'],
        'deleteClassObject' => ['everyone'],

        'getMeetings' => ['everyone'],
        'postMeetings' => ['everyone'],
        'headMeetingObject' => ['everyone'],
        'getMeetingObject' => ['everyone'],
        'patchMeetingObject' => ['everyone'],
        'deleteMeetingObject' => ['everyone'],


        'getClassTopics' => ['everyone'],
        'postClassTopics' => ['everyone'],
        'headClassTopic' => ['everyone'],
        'getClassTopic' => ['everyone'],
        'deleteClassTopic' => ['everyone'],

        'getClassClockHourRecords' => ['everyone'],

        'postRecords' => ['everyone'],
        'getRecords' => ['everyone'],
        'patchRecordObject' => ['everyone'],
        'headRecordObject' => ['everyone'],
        'getRecordObject' => ['everyone'],
        'deleteRecordObject' => ['everyone'],

        'getClassInstructors' => ['everyone'],
        'postClassInstructors' => ['everyone'],
        'headClassInstructor' => ['everyone'],
        'getClassInstructor' => ['everyone'],
        'deleteClassInstructor' => ['everyone'],


        'getEvaluationResponses' => ['everyone'],
        'postEvaluationResponse' => ['everyone'],

        'getEvaluations' => ['everyone'],
        'postEvaluations' => ['everyone'],
        'headEvaluationObject' => ['everyone'],
        'getEvaluationObject' => ['everyone'],
        'patchEvaluationObject' => ['everyone'],
        'deleteEvaluationObject' => ['everyone'],

        'getQuestions' => ['everyone'],
        'postQuestion' => ['everyone'],
        'headQuestionObject' => ['everyone'],
        'getQuestionObject' => ['everyone'],
        'patchQuestionObject' => ['everyone'],
        'deleteQuestionObject' => ['everyone'],

        'getRoles' => ['everyone'],
        'headRoleObject' => ['everyone'],
        'getRoleObject' => ['everyone'],

        'getLocations' => ['everyone'],
        'postLocations' => ['everyone'],
        'headLocationObject' => ['everyone'],
        'getLocationObject' => ['everyone'],
        'patchLocationObject' => ['everyone'],
        'deleteLocationObject' => ['everyone'],

        'getTopics' => ['everyone'],
        'postTopics' => ['everyone'],
        'headTopicObject' => ['everyone'],
        'getTopicObject' => ['everyone'],
        'patchTopicObject' => ['everyone'],
        'deleteTopicObject' => ['everyone'],
    ],
];
?>
