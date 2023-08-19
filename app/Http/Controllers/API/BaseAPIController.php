<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Traits\ResponseProvider;

class BaseAPIController extends Controller
{
    use ResponseProvider;

    protected $responseMessage;

    protected $objectName;

    protected $objectKey;
}
