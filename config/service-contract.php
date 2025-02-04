<?php

return [

    /*
     * When get all data default from servie contract is true.
     */

    'default_paginated' => true,

    /*
     * When get data with paginate, default from service contract 15. You can change in
     * this config or in parameter function all.
     */

    'pagination_per_page' => 10,

    /*
     * When running artisan db:seed command, you can allow dummy data.
     */

    'seeder_faker' => env('SEEDER_FAKER', false),


    /*
     * All configuration for auth base service. You can change config in here.
     */
    'auth' => [

        /**
         * When OTP send to email, user only has 2 minute(s) by default before the OTP
         * expires.
         */
        'otp_expired' => 2,

        /**
         * When OTP validate, user only has 6 minute(s) before the token expires.
         */
        'token_expired' => 6
    ]

];
