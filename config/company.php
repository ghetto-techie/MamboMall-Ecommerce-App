<?php

/**
 * Company Information
 * Used in invoices and other documents
 *
 * @author Mambo Mall
 */
return [
    'name' => env('COMPANY_NAME', env('APP_NAME')),
    'email' => env('COMPANY_EMAIL', 'ngonyoku.002@gmail.com'),
    'phone' => env('COMPANY_PHONE', '+254 707670113'),
    'address' => env('COMPANY_ADDRESS', 'Nairobi, Kenya'),
    'logo' => 'branding/logo.png', // storage/app/public/branding/logo.png
];
