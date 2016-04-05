<?php
use CHMS\Provider\Models\ClassMeeting as ClassMeetingModel;
use CHMS\Provider\Models\ClassRecord as ClassRecordModel;
use CHMS\Provider\Models\ClassTopic as ClassTopicModel;
use CHMS\Provider\Models\ClockHourRecord as ClockHourRecordModel;
use CHMS\Provider\Models\Evaluation as EvaluationModel;
use CHMS\Provider\Models\EvaluationQuestion as EvaluationQuestionModel;
use CHMS\Provider\Models\EvaluationQuestionOption as EvaluationQuestionOptionModel;
use CHMS\Provider\Models\Location as LocationModel;
use CHMS\Provider\Models\Organization as OrganizationModel;
use CHMS\Provider\Models\Role as RoleModel;
use CHMS\Provider\Models\RoleUser as RoleUserModel;
use CHMS\Provider\Models\Topic as TopicModel;
use CHMS\Provider\Models\User as UserModel;


return [
    'roles' => [
        'provider_administrator' => ['name' => 'Provider Administrator', 'context' => 'provider', 'level' => 100],
        'provider_registrar' => ['name' => 'Provider Registrar', 'context' => 'provider', 'level' => 110],
        'provider_reviewer' => ['name' => 'Provider Reviewer', 'context' => 'provider', 'level' => 120],
        'class_creator' => ['name' => 'Class Creator', 'context' => 'class', 'level' => 300],
        'instructor' => ['name' => 'Instructor', 'context' => 'class', 'level' => 310],
        'student' => ['name' => 'Student', 'context' => 'hub', 'level' => 1000],

        'self' => ['name' => 'Self', 'level' => 2000, 'context' => 'hub', 'virtual' => true], // for accessing your own user record
        'guest' => ['name' => 'Guest', 'level' => 9999, 'context' => 'hub', 'virtual' => true],

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
            ['allow', 'roles' => 'provider_reviewer']
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
        ClassMeeting::class => [
            'access' => [
                'role-provider-privileged' => ['read', 'set'], 
                'role-class-privileged' => ['read', 'set'], 
            ],
            'fields' => [
                '*' => true
            ]
        ],
        ClassRecord::class => [
            'access' => [
                'role-provider-privileged' => ['read', 'set'], 
                'role-class-privileged' => ['read', 'set'], 
            ],
            'fields' => [
                '*' => true
            ]
        ],
        ClassTopic::class => [
            'access' => [
                'role-provider-privileged' => ['read', 'set'], 
                'role-class-privileged' => ['read', 'set'], 
            ],
            'fields' => [
                '*' => true
            ]
        ],
        ClockHourRecord::class => [
            'access' => [
                'role-provider-privileged' => ['read', 'set'], 
                'role-class-privileged' => ['read', 'set'], 
            ],
            'fields' => [
                '*' => true
            ]
        ],
        Evaluation::class => [
            'access' => [
                'everyone' => ['read'],
                'role-provider-privileged' => ['read', 'set'],
            ],
            'fields' => [
                '*' => true
            ]
        ],
        EvaluationQuestion::class => [
            'access' => [
                'everyone' => ['read'],
                'role-provider-privileged' => ['read', 'set'],
            ],
            'fields' => [
                '*' => true
            ]
        ],
        EvaluationQuestionOption::class => [
            'access' => [
                'everyone' => ['read'],
                'role-provider-privileged' => ['read', 'set'],
            ],
            'fields' => [
                '*' => true
            ]
        ],
        Location::class => [
            'access' => [
                'everyone' => ['read'],
                'role-provider-privileged' => ['read', 'set'], 
                'role-class-privileged' => ['read', 'set'], 
            ],
            'fields' => [
                '*' => true
            ]
        ],
        Topic::class => [
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
        User::class => [
            'access' => [
                'role-provider-privileged' => ['read', 'set'], 
                'role-class-privileged' => ['read', 'set'], 
            ],
            'fields' => [
                '*' => true
            ]
        ],
        Organization::class => [
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
