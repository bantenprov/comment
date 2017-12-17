<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Demo Config
    |--------------------------------------------------------------------------
    |
    | The following config lines are used for development of package
    | Bantenprov/Comment
    |
    */

    'key' => 'value',
    'models' => [
        'user' => 'App\User',
        'project' => 'Bantenprov\Project\Models\Project',
        'staf' => 'Bantenprov\Staf\Models\Staf',
        'member' => 'Bantenprov\Member\Models\Member',
        'comment' => 'Bantenprov\Comment\Models\Comment',
        'comment_rating' => 'Bantenprov\Comment\Models\CommentRating',
        'task' => 'Bantenprov\Task\Models\Task',
        'tasks' => new Bantenprov\Task\Models\Task,
        'users' => new App\User
    ],
    'available-extention' => [
        'jpg' => 'jpg',
        'jpeg' => 'jpeg',
        'png' => 'png',
        'docx' => 'docx',
        'doc' => 'doc',
        'pdf' => 'pdf',
        'txt' => 'txt'
    ]


];
