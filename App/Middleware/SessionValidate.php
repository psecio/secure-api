<?php

namespace App\Middleware;

class SessionValidate
{
    public function __invoke($request, $response, $next)
    {
        $result = \App\Lib\Session::validate($request);
        if ($result == false) {
            $message = [
                'success' => false,
                'message' => 'Not allowed'
            ];
            $response = $response->withHeader('Content-type', 'application/json');
            $response = $response->withStatus(401);
            $body = $response->getBody();
            $body->write(json_encode($message));

            return $response;
        }

        // Allowed, continue with the execution
        $response = $next($request, $response);
        return $response;
    }
}
