<?php

namespace App\Services;

use App\User;
use App\Author;
use App\AuthorImage;
use App\SocialMedia;
use Illuminate\Http\Request;
use App\Helpers\StringHelper;
use App\Helpers\UploadHelper;
use Illuminate\Support\Facades\DB;

class AuthorService extends BaseService
{

    private $author, $uploadHelper, $stringHelper, $socialMedia;

    public function __construct(Author $author, UploadHelper $uploadHelper, StringHelper $stringHelper, SocialMedia $socialMedia)
    {
        $this->author = $author;
        $this->uploadHelper = $uploadHelper;
        $this->stringHelper = $stringHelper;
        $this->socialMedia = $socialMedia;
        parent::__construct($author);
    }

    public function getAllData(Request $request)
    {
        $search = null;
        $orderBy = null;
        $order = null;


        if ($request->has('orderBy')) $orderBy = $request->query('orderBy');
        if ($request->has('search')) $search = $request->query('search');
        if ($request->has('order')) $order = $request->query('order');

        return  $this->setScope('search', $search)
            ->setValue(['id', 'name', 'pen_name', 'birth_place', 'birth_date', 'residence_place', 'user_id'])
            ->setRelationship(['user:id,name', 'authorImage', 'socialMedias'])
            ->orderBy($orderBy, $order)->getAllDatas();
    }

    public function addData(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $userId = User::getAuthId();
                $author = new Author(array_merge(
                    $request->except(['social_medias', 'author_images']),
                    ['slug' => $this->author->slug($request->name), 'user_id' => $userId]
                ));
                $author->save();
                if ($request->hasFile('author_images')) {
                    $authorImagesName = $this->uploadHelper->uploadFile(
                        $request->author_images,
                        $request->name,
                        'author_images'
                    );
                    $authorImages = [
                        'name' => $authorImagesName,
                        'user_id' =>  $userId,
                    ];

                    $author->authorImage()->create($authorImages);
                }
                foreach ($this->socialMedia->convertToInsertData($request->social_medias) as $socialMedia) {
                    DB::table('author_social_media')->insert(
                        [
                            'author_id' => $author->id,
                            'social_media_id' => $socialMedia['id'],
                            'url' => $socialMedia['url']
                        ]
                    );
                }
            });
        } catch (\Throwable $th) {
            return $th;
            return 'Failed';
        }
        return "Success";
    }

    public function updateData(Request $request, $authorId)
    {
        try {
            DB::transaction(function () use ($request, $authorId) {
                $author = $this->author->findOrFail($authorId);

                $author->name = $request->name;
                $author->pen_name = $request->pen_name;
                $author->birth_place = $request->birth_place;
                $author->birth_date = $request->birth_date;
                $author->residence_place = $request->residence_place;
                $author->save();

                if ($request->hasFile('author_images')) {
                    $authorImagesName = $this->uploadHelper->uploadFile(
                        $request->author_images,
                        $request->name,
                        'author_images'
                    );
                    $authorImages = [
                        'name' => $authorImagesName,
                        'user_id' =>   User::getAuthId(),
                    ];

                    if ($author->authorImage) {
                        $this->uploadHelper->deleteFile($author->authorImage->name);
                    }
                    AuthorImage::updateOrCreate(
                        ['author_id' => $author->id, 'user_id' => User::getAuthId()],
                        ['name' => $authorImagesName]
                    );
                }
                foreach ($this->socialMedia->convertToInsertData($request->social_medias) as $socialMedia) {

                    DB::table('author_social_media')
                        ->updateOrInsert(
                            ['author_id' => $author->id, 'social_media_id' => $socialMedia['id']],
                            ['url' => $socialMedia['url']]
                        );
                }
            });
        } catch (\Throwable $th) {
            return $th;
            return 'Failed';
        }
        return "Success";
    }

    public function deleteData($authorId)
    {
        try {
            $this->author->destroy($authorId);
        } catch (\Throwable $th) {
            return "Fail";
        }
        return "Success";
    }
}
