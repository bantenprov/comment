<?php namespace Bantenprov\Comment\Http\Middleware;

use Closure;

/**
 * The CommentMiddleware class.
 *
 * @package Bantenprov\Comment
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class CommentMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $next($request);
    }
}
