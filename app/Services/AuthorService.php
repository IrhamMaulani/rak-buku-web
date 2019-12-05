<?php

namespace App\Services;

use App\User;
use App\Author;
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

        return  $this->setScope('search', $search)->setValue(['id', 'name', 'pen_name'])
            ->orderBy($orderBy, $order)->getAllDatas();
    }

    public function addData(Request $request){
        
         try {
            DB::transaction(function () use ($request) {
                $userId = User::getAuthId();
                 $author = new Author(array_merge($request->except(['social_medias', 'author_images']),
                ['slug' => $this->author->slug($request->name), 'user_id' => $userId]));
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
                    ['author_id' => $author->id, 
                    'social_media_id' => $socialMedia['id'],
                     'url' => $socialMedia['url']
                     ]);
                }
                
            }); 
        } catch (\Throwable $th) {
            return $th;
            return 'Failed';
        }
        return "Success";
    }
}
