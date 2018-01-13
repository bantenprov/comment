<?php namespace Bantenprov\Comment\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * The Comment facade.
 *
 * @package Bantenprov\Comment
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class Comment extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'comment';
    }
}
