<?php namespace Bantenprov\Comment\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use willvincent\Rateable\Rateable;

/**
 * The CommentModel class.
 *
 * @package Bantenprov\Comment
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class CommentRating extends Model
{    

    public $timesstamps = true;    
    
    protected $table = 'comment_ratings';

    protected $fillable = ['user_id','comment_id','rating'];

    /* Table relation */

    public function getUser()
    {
        return $this->hasOne(config('comment.models.user'),'id','user_id');
        //return $this->belongsTo(config('comment.models.user'),'user_id','id');
    }

    public function getComment()
    {
        //return $this->belongsTo('Bantenprov\Task\Models\Task','task_id','id');
        //return $this->belongsTo(config('comment.models.task'),'task_id','id');
        return $this->hasOne(config('comment.models.comment'),'id','comment_id');
    }
}
