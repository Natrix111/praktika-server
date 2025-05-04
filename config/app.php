<?php
return [
    'auth' => \Src\Auth\Auth::class,
    'identity' => \Model\User::class,
    'routeMiddleware' => [
        'auth' => \Middlewares\AuthMiddleware::class,
        'admin' => \Middlewares\AdminMiddleware::class,
        'employee' => \Middlewares\EmployeeMiddleware::class,
    ],
    'routeAppMiddleware' => [
        'trim' => \Middlewares\TrimMiddleware::class,
        'specialChars' => \Middlewares\SpecialCharsMiddleware::class,
    ],
    'validators' => [
        'required' => \Validators\RequireValidator::class,
        'unique' => \Validators\UniqueValidator::class,
        'numeric' => \Validators\NumericValidator::class,
        'positive' => \Validators\PositiveValidator::class,
        'image' => \Validators\ImageValidator::class,
        'min' => \Validators\MinValidator::class,
        'area_available' => \Validators\AreaAvailableValidator::class
    ]
];