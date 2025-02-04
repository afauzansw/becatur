<?php

namespace App\Utils;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Inertia\Inertia;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;

class WebResponse
{
    public static function inertia($result, $redirectRoute, $param = null)
    {
        if ($result instanceof Exception) {
            return back()->withErrors('errors', $result->getMessage());
        } else {
            if (is_null($redirectRoute)) return redirect()->back();
            return Inertia::location(route($redirectRoute, $param));
        }
    }

    public static function inertiaRender($result, $render, $param = [])
    {
        if ($result instanceof Exception) {
            return back()->withErrors('errors', $result->getMessage());
        } else {
            return Inertia::render($render, $param ?? $result);
        }
    }

    public static function baseJson($data, $message = 'Success', $status = 200)
    {
        return response()->json([
            'message' => $message,
            'data' => $data,
        ], $status);
    }

    public static function json($result, $messageSuccess = '')
    {
        if ($result instanceof AuthorizationException) {
            return self::baseJson(["message" => $result->getMessage()], $result->getMessage(), 401);
        } else if ($result instanceof ModelNotFoundException) {
            return self::baseJson(["message" => $result->getMessage()], $result->getMessage(), 404);
        } else if ($result instanceof MethodNotAllowedException) {
            return self::baseJson(["message" => $result->getMessage()], $result->getMessage(), 405);
        } else if ($result instanceof HttpResponseException) {
            return self::baseJson(["message" => $result->getMessage()], $result->getMessage(), 422);
        } else if ($result instanceof Exception) {
            return self::baseJson(["message" => $result->getMessage()], $result->getMessage(), 400);
        } else {
            return self::baseJson($result, $messageSuccess);
        }
    }
}
