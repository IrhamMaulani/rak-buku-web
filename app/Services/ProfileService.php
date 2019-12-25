<?php

namespace App\Services;

use App\User;
use App\UserImage;
use Illuminate\Http\Request;
use App\Helpers\UploadHelper;
use Illuminate\Support\Facades\DB;

class ProfileService extends BaseService
{
    private $user, $userImage;

    public function __construct(User $user, UploadHelper $uploadHelper, UserImage $userImage)
    {
        $this->user = $user;
        $this->uploadHelper = $uploadHelper;
        $this->userImage = $userImage;
    }

    public function getData($userName)
    {

        return $this->user->with(['reputation', 'imageProfile'])->whereName($userName)->first();
    }

    public function updateData(Request $request, $userName)
    {
        try {
            DB::transaction(function () use ($request, $userName) {
                $userId = $this->user->getAuthId();
                $user = $this->user->whereName($userName)->whereId($userId)->first();
                $user->full_name = $request->full_name;
                $user->name = $request->name;
                $user->email = $request->email;
                $user->save();

                if ($request->hasFile('image_profile')) {
                    $userImage = $this->userImage->whereUserId($userId)->whereIsUse(1)->first();
                    if ($userImage) {
                        $userImage->is_use = 0;
                        $userImage->save();
                    }
                    $profileImageName = $this->uploadHelper->uploadFile(
                        $request->image_profile,
                        $request->title,
                        'user_profiles'
                    );
                    $user->imageProfile()->updateOrCreate(
                        ['user_id' =>  $userId],
                        ['name' => $profileImageName, 'is_use' => 1]
                    );
                }
            });
        } catch (\Throwable $th) {
            return $th;
            return 'Failed';
        }
        return "Success";
    }
}
