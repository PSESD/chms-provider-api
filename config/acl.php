<?php
use CHMS\ProviderHub\Models\ClassMeeting as ClassMeetingModel;
use CHMS\ProviderHub\Models\ClassRecord as ClassRecordModel;
use CHMS\ProviderHub\Models\ClassTopic as ClassTopicModel;
use CHMS\ProviderHub\Models\ClockHourRecord as ClockHourRecordModel;
use CHMS\ProviderHub\Models\Evaluation as EvaluationModel;
use CHMS\ProviderHub\Models\EvaluationQuestion as EvaluationQuestionModel;
use CHMS\ProviderHub\Models\EvaluationQuestionOption as EvaluationQuestionOptionModel;
use CHMS\ProviderHub\Models\Location as LocationModel;
use CHMS\ProviderHub\Models\Organization as OrganizationModel;
use CHMS\ProviderHub\Models\Role as RoleModel;
use CHMS\ProviderHub\Models\RoleUser as RoleUserModel;
use CHMS\ProviderHub\Models\Provider as ProviderModel;
use CHMS\ProviderHub\Models\Topic as TopicModel;
use CHMS\ProviderHub\Models\User as UserModel;


return [
    'roles' => [
        'super_administrator' => ['name' => 'Super Administrator', 'context' => 'hub', 'level' => 10],
        'hub_administrator' => ['name' => 'Hub Administrator', 'context' => 'hub', 'level' => 11],
        'provider_administrator' => ['name' => 'Provider Administrator', 'context' => 'provider', 'level' => 100],
        'provider_registrar' => ['name' => 'Provider Registrar', 'context' => 'provider', 'level' => 110],
        'provider_reviewer' => ['name' => 'Provider Reviewer', 'context' => 'provider', 'level' => 120],
        'class_creator' => ['name' => 'Class Creator', 'context' => 'class', 'level' => 300],
        'instructor' => ['name' => 'Instructor', 'context' => 'class', 'level' => 310],
        'student' => ['name' => 'Student', 'context' => 'provider', 'level' => 1000],

        'self' => ['name' => 'Self', 'level' => 2000, 'context' => 'provider', 'virtual' => true], // for accessing your own user record
        'guest' => ['name' => 'Guest', 'level' => 9999, 'context' => 'provider', 'virtual' => true],

        'client_hub' => ['name' => 'Hub Client', 'level' => 0, 'context' => 'client', 'virtual' => true]
    ],
    'globalRules' => [
        ['allow', 'roles' => 'provider_administrator', 'privileges' => null],
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
        'role-provider-admins' => [
            ['allow', 'roles' => 'provider_administrator']
        ],
        'role-provider-privileged' => [
            ['allow', 'roles' => 'provider_administrator'],
            ['allow', 'roles' => 'provider_registrar'],
            ['allow', 'roles' => 'provider_reviewer'],
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
                'role-provider-privileged' => ['read', 'set'],
                'role-class-privileged' => ['read', 'set'],
            ],
            'fields' => [
                '*' => true
            ]
        ],
        ClassRecordModel::class => [
            'access' => [
                'role-provider-privileged' => ['read', 'set'],
                'role-class-privileged' => ['read', 'set'],
            ],
            'fields' => [
                '*' => true
            ]
        ],
        ClassTopicModel::class => [
            'access' => [
                'role-provider-privileged' => ['read', 'set'],
                'role-class-privileged' => ['read', 'set'],
            ],
            'fields' => [
                '*' => true
            ]
        ],
        ClockHourRecordModel::class => [
            'access' => [
                'role-provider-privileged' => ['read', 'set'],
                'role-class-privileged' => ['read', 'set'],
            ],
            'fields' => [
                '*' => true
            ]
        ],
        EvaluationModel::class => [
            'access' => [
                'everyone' => ['read'],
                'role-provider-privileged' => ['read', 'set'],
            ],
            'fields' => [
                '*' => true
            ]
        ],
        EvaluationQuestionModel::class => [
            'access' => [
                'everyone' => ['read'],
                'role-provider-privileged' => ['read', 'set'],
            ],
            'fields' => [
                '*' => true
            ]
        ],
        EvaluationQuestionOptionModel::class => [
            'access' => [
                'everyone' => ['read'],
                'role-provider-privileged' => ['read', 'set'],
            ],
            'fields' => [
                '*' => true
            ]
        ],
        LocationModel::class => [
            'access' => [
                'everyone' => ['read'],
                'role-provider-privileged' => ['read', 'set'],
                'role-class-privileged' => ['read', 'set'],
            ],
            'fields' => [
                '*' => true
            ]
        ],
        TopicModel::class => [
            'access' => [
                'role-provider-privileged' => ['read', 'set'],
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
                'role-provider-privileged' => ['read', 'set'],
                'role-class-privileged' => ['read', 'set'],
            ],
            'fields' => [
                '*' => true
            ]
        ],
        OrganizationModel::class => [
            'access' => [
                'role-provider-privileged' => ['read', 'set'],
                'role-class-privileged' => ['read', 'set'],
            ],
            'fields' => [
                '*' => true
            ]
        ],
        ProviderModel::class => [
            'access' => [
                'role-provider-privileged' => ['read', 'set'],
                'role-class-privileged' => ['read', 'set'],
            ],
            'fields' => [
                '*' => true
            ]
        ],
    ],
    'routeRules' => [

        'getProviders' => ['everyone'],
        'postProviders' => ['everyone'],
        'headProviderObject' => ['everyone'],
        'getProviderObject' => ['everyone'],
        'patchProviderObject' => ['everyone'],
        'deleteProviderObject' => ['everyone'],

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
