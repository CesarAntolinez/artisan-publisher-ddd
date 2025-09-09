<?php

namespace Writing\Infrastructure\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Writing\Application\UseCases\AddComment\AddCommentHandler;
use Writing\Infrastructure\Http\Requests\Api\V1\AddCommentRequest;

class AddCommentController extends Controller
{
    public function __construct(private readonly AddCommentHandler $handler)
    {
    }

    public function __invoke(AddCommentRequest $request, string $articleId): JsonResponse
    {
        $this->handler->handle(
            $articleId,
            $request->validated('author'),
            $request->validated('text')
        );

        return response()->json(['message' => 'Comment added successfully.'], 201);
    }
}
