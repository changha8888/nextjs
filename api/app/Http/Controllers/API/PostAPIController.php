<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePostAPIRequest;
use App\Http\Requests\API\UpdatePostAPIRequest;
use App\Models\Post;
use App\Repositories\PostRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Response;

/**
 * Class PostController
 * @package App\Http\Controllers\API
 */

class PostAPIController extends AppBaseController
{
    /** @var  PostRepository */
    private $postRepository;

    public function __construct(PostRepository $postRepo)
    {
        $this->postRepository = $postRepo;
    }

    /**
     * Display a listing of the Post.
     * GET|HEAD /posts
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $posts = $this->postRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($posts->toArray(), 'Posts retrieved successfully');
    }

    /**
     * Store a newly created Post in storage.
     * POST /posts
     *
     * @param CreatePostAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePostAPIRequest $request)
    {
        $input = $request->all();
        $image = $input['image'];
//        $path = Storage::disk('s3')->put('images/originals', $request->image, 'public');
//        $image_normal = Image::make($image)->widen(800, function ($constraint) {
//            $constraint->upsize();
//        });
//        $image_thumb = Image::make($image)->crop(100,100);
//        $image_normal = $image_normal->stream();
//        $image_thumb = $image_thumb->stream();
//        dd($image_thumb->__toString());
//        $path = Storage::disk('s3')->put('images/originals', $image_normal->__toString());
//        Storage::disk('s3')->put('thumbnails/'.$image, $image_thumb);
        $path = Storage::disk('s3')->put('images/originals', $request->image, 'public');
        $input['image'] = $path;
        $input['slug'] = Str::slug($input['title']);
        $post = $this->postRepository->create($input);

        return $this->sendResponse($post->toArray(), 'Post saved successfully');
    }

    /**
     * Display the specified Post.
     * GET|HEAD /posts/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Post $post */
        $post = $this->postRepository->find($id);

        if (empty($post)) {
            return $this->sendError('Post not found');
        }

        return $this->sendResponse($post->toArray(), 'Post retrieved successfully');
    }

    /**
     * Update the specified Post in storage.
     * PUT/PATCH /posts/{id}
     *
     * @param int $id
     * @param UpdatePostAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePostAPIRequest $request)
    {
        $input = $request->all();

        /** @var Post $post */
        $post = $this->postRepository->find($id);

        if (empty($post)) {
            return $this->sendError('Post not found');
        }

        $post = $this->postRepository->update($input, $id);

        return $this->sendResponse($post->toArray(), 'Post updated successfully');
    }

    /**
     * Remove the specified Post from storage.
     * DELETE /posts/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Post $post */
        $post = $this->postRepository->find($id);

        if (empty($post)) {
            return $this->sendError('Post not found');
        }

        $post->delete();

        return $this->sendSuccess('Post deleted successfully');
    }
}
