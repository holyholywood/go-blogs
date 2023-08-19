<?php

namespace App\Services;

use App\Services\BaseService;
use App\Repositories\UserRepository;

class UserService extends BaseService
{
    public function __construct(UserRepository $userRepository)
    {
        parent::__construct($userRepository);
    }
    public function update($id, array $data)
    {
        if (!$data['password']) {
            unset($data['password']);
        }
        return $this->repository->update($id, $data);
    }
}
