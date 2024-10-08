<?php

namespace App\App\Api\Controllers;

use App\App\Api\Requests\CreateCommentRequest;
use App\Domain\Comment\Actions\CreateCommentAction;
use App\Domain\Comment\Actions\DeleteCommentAction;
use App\Domain\Comment\Actions\GetCommentAction;
use App\Infrastructure\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct(public CreateCommentAction $createCommentAction, public GetCommentAction $getCommentAction, public DeleteCommentAction $deleteCommentAction)
    {
    }

    public function index(Request $request)
    {
        return $this->getCommentAction->handle($request->id);
    }

    public function store(CreateCommentRequest $request)
    {
        $comment = $this->createCommentAction->handle($request);

        return response()->json($comment);
    }

    public function destroy($id) {
        return $this->deleteCommentAction->handle($id);
    }
}
