<?php
return [
    "title" => "Register now",
    "subtitle" => "Personal Information",
    "form" => [
        "nombre"    => "Name",
        "apellidos" => "Last Name",
        "email"     => "Email",
        "password"  => "Password <small>(longer than 6 characters)</small>"
    ],
    "links" => [
        "condiciones" => [
            "title" => "Terms and Conditions",
            "link"  => "/condiciones",
        ],
        "politica_datos" => [
            "title" => "Data policy",
            "link"  => "/politica",
        ]
    ],
    "other" => [
        "planes" => [
            "title" => "Plans",
            "description" => "Choose subscription type",
            "time" => "month",
            "plan1" => [
                "title" => "Free",
                "desc" => "Free access to the 10% of the entire catalog of books"
            ],
            "plan2" => [
                "title" => "Basic",
                "desc" => "Access to the entire catalog of books, 2 user profiles"
            ],
            "plan3" => [
                "title" => "Familiar",
                "desc" => "Access to the entire catalog of books, 4 user profiles"
            ]
        ]
    ]
];
