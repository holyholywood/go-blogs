<?php

namespace App\Services;

use App\Services\BaseService;
use App\Repositories\CommentRepository;

class CommentService extends BaseService
{
    public function __construct(CommentRepository $commentRepository)
    {
        parent::__construct($commentRepository);
    }
}
