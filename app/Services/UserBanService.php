<?php

namespace App\Services;

use App\User;

class UserBanService extends BaseService
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
        parent::__construct($user);
    }

    public function updateBan($statusBan, $userId)
    {
        try {
            $user = $this->user->findOrFail($userId);
            $user->is_ban = $statusBan;
            $user->save();
        } catch (\Throwable $th) {
            return "Failed";
        }
        return "Success";
    }
}
