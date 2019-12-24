<?php

namespace App\Services;

use App\Tag;
use App\Book;
use App\BookImage;
use App\User;
use App\Score;
use Illuminate\Http\Request;
use App\Helpers\StringHelper;
use App\Helpers\UploadHelper;
use Illuminate\Support\Facades\DB;

class BookService extends BaseService
{
    private $book, $score, $tag, $stringHelper;
    public function __construct(Book $book, Score $score, Tag $tag, UploadHelper $uploadHelper, StringHelper $stringHelper)
    {
        $this->book = $book;
        $this->score = $score;
        $this->tag = $tag;
        $this->uploadHelper = $uploadHelper;
        $this->stringHelper = $stringHelper;
        parent::__construct($book);
    }
    public function getAllData(Request $request)
    {
        $search = null;
        $tag = null;
        $orderBy = null;
        $order = null;
        $limit = 5;
        $author = null;
        $publisher = null;

        if ($request->has('orderBy')) $orderBy = $request->query('orderBy');
        if ($request->has('search')) $search = $request->query('search');
        if ($request->has('tag')) $tag = $request->query('tag');
        if ($request->has('order')) $order = $request->query('order');
        if ($request->has('limit')) $limit = $request->query('limit');
        if ($request->has('author')) $author = $request->query('author');
        if ($request->has('publisher')) $publisher = $request->query('publisher');

        return  $this->setRelationship(['authors:id,name,pen_name', 'checkBookmarked', 'tags:id,name',  'bookImagesCover', 'publisher:id,name'])
            ->setScope('search', $search)->setScope('publisher', $publisher)->setScope('author', $author)->setScope('tag', $tag)
            ->orderBy($orderBy, $order)->getDataPagination($limit);
    }

    public function getAllDataAdmin(Request $request)
    {
        $search = null;
        $tag = null;
        $orderBy = null;
        $order = null;
        $limit = 5;
        $author = null;
        $publisher = null;

        if ($request->has('orderBy')) $orderBy = $request->query('orderBy');
        if ($request->has('search')) $search = $request->query('search');
        if ($request->has('tag')) $tag = $request->query('tag');
        if ($request->has('order')) $order = $request->query('order');
        if ($request->has('limit')) $limit = $request->query('limit');
        if ($request->has('author')) $author = $request->query('author');
        if ($request->has('publisher')) $publisher = $request->query('publisher');

        return  $this->setRelationship(['authors:id,name,pen_name', 'tags:id,name', 'bookImagesCover', 'publisher:id,name'])
            ->setScope('search', $search)->setScope('publisher', $publisher)->setScope('author', $author)->setScope('tag', $tag)
            ->orderBy($orderBy, $order)->getAllDatas();
    }

    public function getData($slug)
    {
        return $this->book->with(['authors:id,name,pen_name', 'tags:id,name', 'checkBookmarked', 'bookImagesCover', 'publisher:id,name', 'userScore', "userReview.user.imageProfile"])
            ->whereSlug($slug)->first();
    }
    public function addData(Request $request)
    {

        try {
            DB::transaction(function () use ($request) {

                $userId = User::getAuthId();
                $book = new Book(array_merge(
                    $request->except(['book_images', 'tags', 'authors', 'book_images_cover', 'publisher', 'tags_json', 'authors_json']),
                    ['slug' => $this->book->slug($request->title, $request->volume, $request->edition)]
                ));
                $book->save();
                if ($request->hasFile('book_images')) {
                    $bookImagesName = $this->uploadHelper->uploadFile(
                        $request->book_images,
                        $request->title,
                        'book_images'
                    );
                    $bookImages = [
                        'name' => $bookImagesName,
                        'user_id' =>  $userId,
                        'is_cover' => 1
                    ];

                    $book->bookImages()->create($bookImages);
                }
                $book->tags()->sync($this->book->getIdForSync(json_decode($request->tags_json)));
                $book->authors()->sync($this->book->getIdForSync(json_decode($request->authors_json)));
            });
        } catch (\Throwable $th) {
            return $th;
            return 'Failed';
        }
        return "Success";
    }

    public function updateData(Request $request, $bookId)
    {
        try {
            DB::transaction(function () use ($request, $bookId) {
                $book = $this->book->findOrFail($bookId);

                $book->title = $request->title;
                $book->volume = $request->volume;
                $book->edition = $request->edition;
                $book->print_year = $request->print_year;
                $book->origin_language = $request->origin_language;
                $book->description = $request->description;
                $book->publisher_id = $request->publisher_id;

                $book->save();

                if ($request->hasFile('book_images')) {
                    $bookImagesName = $this->uploadHelper->uploadFile(
                        $request->book_images,
                        $request->title,
                        'book_images'
                    );
                    $bookImages = [
                        'name' => $bookImagesName,
                        'user_id' =>  User::getAuthId(),
                        'is_cover' => 1
                    ];

                    $bookImage = BookImage::whereBookId($book->id)->whereIsCover(1)->latest()->first();
                    $bookImage->is_cover = 0;
                    $bookImage->save();

                    $book->bookImages()->create($bookImages);
                }
                $book->tags()->sync($this->book->getIdForSync(json_decode($request->tags_json)));
                $book->authors()->sync($this->book->getIdForSync(json_decode($request->authors_json)));
            });
        } catch (\Throwable $th) {
            return $th;
            return 'Failed';
        }
        return "Success";
    }

    public function deleteData($bookId)
    {
        try {
            $this->book->destroy($bookId);
        } catch (\Throwable $th) {
            return "Fail";
        }
        return "Success";
    }
}
