<?php

namespace App\Http\Filters\V1;

use App\Http\Filters\ApiFilter;

class UserFilter extends ApiFilter
{
    protected $safeParams = [
        'name' => ['eq'],
        'email' => ['eq']
    ];
}