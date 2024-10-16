<?php

namespace App\App\Api\Controllers;

use App\App\Api\Requests\CreatePostRequest;
use App\App\Api\Requests\UpdatePostRequest;
use App\Domain\Post\Actions\CreatePostAction;
use App\Domain\Post\Actions\DeletePostAction;
use App\Domain\Post\Actions\GetPostAction;
use App\Domain\Post\Actions\UpdatePostAction;
use App\Domain\Post\Actions\SearchPostAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct(
        public SearchPostAction $searchPostAction,
        public CreatePostAction $createPostAction,
        public UpdatePostAction $updatePostAction,
        public DeletePostAction $deletePostAction,
        public GetPostAction $getPostAction) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->searchPostAction->handle($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(CreatePostRequest $request)
    {
        $data = $request->only('title', 'content', 'images');
        $data['created_by'] = Auth::id();

        return $this->createPostAction->handle($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->getPostAction->handle($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(string $id, UpdatePostRequest $request)
    {
        $data = $request->only('title', 'content', 'images');
        return $this->updatePostAction->handle($id, $data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->deletePostAction->handle($id);
    }
}
