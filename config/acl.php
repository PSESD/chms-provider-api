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
        'super_administrator' => ['name' => 'Super Administrator', 'context' => 'hub', 'level' => 10],
        'hub_administrator' => ['name' => 'Hub Administrator', 'context' => 'hub', 'level' => 11],
        'provider_administrator' => ['name' => 'Provider Administrator', 'context' => 'provider', 'level' => 100],
        'provider_registrar' => ['name' => 'Provider Registrar', 'context' => 'provider', 'level' => 110],
        'provider_reviewer' => ['name' => 'Provider Reviewer', 'context' => 'provider', 'level' => 120],
        'organization_admin' => ['name' => 'Organization Admin', 'context' => 'organization', 'level' => 200],
        'class_creator' => ['name' => 'Class Creator', 'context' => 'class', 'level' => 300],
        'instructor' => ['name' => 'Instructor', 'context' => 'class', 'level' => 310],
        'student' => ['name' => 'Student', 'context' => 'hub', 'level' => 1000],
        'self' => ['name' => 'Self', 'level' => 2000, 'context' => 'hub', 'virtual' => true], // for accessing your own user record
        'guest' => ['name' => 'Guest', 'level' => 9999, 'context' => 'hub', 'virtual' => true],

        'client_hub' => ['name' => 'Hub Client', 'level' => 0, 'context' => 'client', 'virtual' => true],
        'client_provider' => ['name' => 'Provider Client', 'level' => 1, 'context' => 'client', 'virtual' => true]
    ],
    'globalRules' => [
        ['allow', 'roles' => 'super_administrator', 'privileges' => null],
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
        ],
        'token_hash' => [
            'role-hub-admins' => ['set']
        ]
    ],
    'modelRules' => [
        PostalAddressModel::class => [
            'access' => [
                'role-self' => ['read', 'set'],
                'role-hub-admins' => ['read'], 
                'role-provider-privileged' => ['read'], 
                'role-class-privileged' => ['read'], 
            ],
            'fields' => [
                '*' => true,
                'object_id' => [
                    'role-self' => ['read', 'set_on_create'],
                    'role-hub-admins' => ['read', 'set_on_create'], 
                    'role-provider-privileged' => ['read'], 
                    'role-class-privileged' => ['read'], 
                ]
            ]
        ],
        PhoneNumberModel::class => [
            'access' => [
                'role-self' => ['read', 'set'],
                'role-hub-admins' => ['read'], 
                'role-provider-privileged' => ['read'], 
                'role-class-privileged' => ['read'], 
            ],
            'fields' => [
                '*' => true,
                'object_id' => [
                    'role-self' => ['read', 'set_on_create'],
                    'role-hub-admins' => ['read', 'set_on_create'], 
                    'role-provider-privileged' => ['read'], 
                    'role-class-privileged' => ['read'], 
                ]
            ]
        ],
        ClientModel::class => [
            'access' => [
                'role-hub-admins' => ['read', 'set'], 
            ],
            'fields' => [
                '*' => true,
                'secret' => []
            ]
        ],
        UserModel::class => [
            'access' => [
                'role-hub-admins' => ['read', 'set'], 
                'role-provider-privileged' => ['read', 'set_on_create'], 
                'role-class-privileged' => ['read', 'set_on_create'], 
                'role-self' => ['read', 'set'],
                'role-client-provider' => ['read', 'set_on_create'],
                'role-client-hub' => ['read', 'set_on_create'],
            ],
            'fields' => [
                '*' => true,
                'password' => [
                    'everyone' => ['set_on_create'],
                    'role-self' => ['set']
                ],
                'ssn' => [
                    'role-hub-admins' => ['read'], 
                    'role-provider-privileged' => ['read'], 
                    'role-self' => ['read', 'set'],
                ],
                'instructor_qualifications' => [
                    'role-hub-admins' => ['read', 'set'], 
                    'role-provider-privileged' => ['read', 'set'], 
                    'role-class-privileged' => ['read'],
                    'role-self' => ['read', 'set'],
                ],
                'last_login' => [
                    'role-hub-admins' => ['read'], 
                    'role-provider-privileged' => ['read'], 
                    'role-self' => ['read'],
                ],
                'active' => [
                    'role-hub-admins' => ['read', 'set'], 
                    'role-provider-privileged' => ['read'], 
                    'role-class-privileged' => ['read'], 
                ]
            ]
        ],
        OrganizationModel::class => [
            'access' => [
                'everyone' => ['read'],
                'role-hub-admins' => ['read', 'set'], 
                'role-organization-privileged' => ['read', 'set'],
                'role-provider-privileged' => ['read', 'set_on_create'], 
                'role-class-privileged' => ['read', 'set_on_create'],
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
        ProviderModel::class => [
            'access' => [
                'everyone' => ['read'],
                'role-hub-admins' => ['read', 'set'],
                'role-client-hub' => ['read']
            ],
            'fields' => [
                '*' => true,
                'client_id' => [
                    'role-hub-admins' => ['read', 'set'], 
                ],
                'provider_prefix' => [
                    'role-hub-admins' => ['read', 'set'], 
                ],
                'provider_api_url' => [
                    'role-hub-admins' => ['read', 'set'],
                    'role-client-hub' => ['read']
                ],
                'provider_api_secret' => [
                    'role-hub-admins' => ['set']
                ]
            ]
        ],
        ClassReferenceModel::class => [
            'access' => [
                'everyone' => ['read'],
                'role-hub-admins' => ['read', 'set'],
                'role-provider-privileged' => ['read', 'set']
            ],
            'fields' => [
                '*' => true,
            ]
        ],
        RecordModel::class => [
            'access' => [
                'role-hub-admins' => ['read', 'set'], 
                'role-client-provider' => ['check', 'set'],
                'role-self' => ['read', 'set'],
                'role-provider-privileged' => ['read', 'set']
                // todo: add org admins
            ],
            'fields' => [
                '*' => true,
                'user_id' => [
                    'role-hub-admins' => ['read', 'set_on_create'], 
                    'role-client-provider' => ['check', 'set_on_create'],
                    'role-self' => ['read', 'set_on_create'],
                    // todo: add org admins
                ],
                'is_user_entered' => [],
                'is_paid' => [
                    'role-provider-privileged' => ['read', 'set']
                ],
                'is_evaluation_sent' => [],
                'is_attendance_confirmed' => [
                    'role-class-privileged' => ['read', 'set']
                ]
            ]
        ],
        // @todo update this to be accurate
        PaymentTransactionModel::class => [
            'access' => [
                'role-hub-admins' => ['check', 'set'], 
                'role-provider-privileged' => ['read', 'set'], 
                'role-client-provider' => ['check', 'set'],
                'role-self' => ['read', 'set'],
            ],
            'fields' => [
                '*' => [
                    'role-hub-admins' => ['check'], 
                    'role-provider-privileged' => ['read'], 
                    // 'role-client-provider' => ['check'],
                    'role-self' => ['read'],
                ]
            ]
        ],
    ],
    'routeRules' => [
        'authClient' => ['everyone'],
        'authRefresh' => ['everyone'],
        'postUsers' => ['everyone'],
        'authLogin' => ['everyone'],

        'getUsers' => ['role-hub-admins'],
        'headUserObjectByEmail' => ['role-hub-admins', 'role-provider-privileged', 'role-class-privileged'],
        'getUserObject' => ['everyone'],
        'headUserObject' => ['everyone'],
        'mergeUserObject' => ['everyone'],
        'patchUserObject' => ['everyone'],
        'deleteUserObject' => ['everyone'],

        'getUserObjectProviders' => ['everyone'],
        'getUserProviderRel' => ['everyone'],
        'headUserProviderRel' => ['everyone'],
        'putUserProviderRel' => ['everyone'],
        'deleteUserProviderRel' => ['everyone'],

        'getUserObjectOrganizations' => ['everyone'],
        'getUserOrganizationRel' => ['everyone'],
        'headUserOrganizationRel' => ['everyone'],
        'putUserOrganizationRel' => ['everyone'],
        'deleteUserOrganizationRel' => ['everyone'],

        'getUserObjectRecords' => ['everyone'],
        'getUserObjectTranscript' => ['everyone'],

        'getRoles' => ['everyone'],
        'headRoleObject' => ['everyone'],
        'getRoleObject' => ['everyone'],

        'getRecords' => ['everyone'],
        'postRecords' => ['everyone'],
        'headRecordObject' => ['everyone'],
        'getRecordObject' => ['everyone'],
        'patchRecordObject' => ['everyone'],
        'deleteRecordObject' => ['everyone'],

        'getClasses' => ['everyone'],
        'postClasses' => ['everyone'],
        'headClassObject' => ['everyone'],
        'getClassObject' => ['everyone'],
        'patchClassObject' => ['everyone'],
        'deleteClassObject' => ['everyone'],

        'getOrganizations' => ['everyone'],
        'postOrganizations' => ['everyone'],
        'headOrganizationObject' => ['everyone'],
        'getOrganizationObject' => ['everyone'],
        'patchOrganizationObject' => ['everyone'],
        'deleteOrganizationObject' => ['everyone'],
        'getProviders' => ['role-hub-admins', 'role-client-hub'],
        'postProviders' => ['role-super'],
        'headProviderObject' => ['role-super'],
        'getProviderObject' => ['role-super'],
        'patchProviderObject' => ['role-super'],
        'deleteProviderObject' => ['role-super']
    ],
    'ruleSets' => [
        // note: for route rules, no context is pulled first. For example, any rule that references 'instructor' would allow ANY instructor
        'everyone' => [
            ['allow', 'roles' => null],
            ['deny', 'roles' => 'guest']
        ],
        'role-hub-admins' => [
            ['allow', 'roles' => 'hub_administrator']
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
        'role-organization-privileged' => [
            //['allow', 'roles' => 'organization_admin_self']
        ],
        'role-client-hub' => [
            ['allow', 'roles' => 'client_hub']
        ],
        'role-client-provider' => [
            ['allow', 'roles' => 'client_provider']
        ],
        'role-client' => [
            ['allow', 'roles' => ['client_provider', 'client_hub']]
        ],
        'role-self' => [
            ['allow', 'roles' => ['self']]
        ],
        'role-super' => [] // caught by global rule for super admin
    ],
];
?>
