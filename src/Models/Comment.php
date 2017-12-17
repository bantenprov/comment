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
class Comment extends Model
{
    use SoftDeletes;
    use Rateable;

    public $timesstamps = true;

    protected $dates = ['deleted_at'];
    
    protected $table = 'comment';

    protected $fillable = ['task_id','user_id','title','comment','url','file'];

    protected $hidden = ['deleted_at'];

    /* Table relation */

    public function getUser()
    {
        return $this->hasOne(config('comment.models.user'),'id','user_id');
        //return $this->belongsTo(config('comment.models.user'),'user_id','id');
    }

    public function getTask()
    {
        //return $this->belongsTo('Bantenprov\Task\Models\Task','task_id','id');
        return $this->belongsTo(config('comment.models.task'),'task_id','id');
    }

    public function comment_rating()
    {
        // return $this->belongsTo(config('comment.models.comment_rating'),'comment_id','id*');
        return $this->hasMany(config('comment.models.comment_rating'));
    }
}
