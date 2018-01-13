<?php namespace Bantenprov\Comment\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Bantenprov\Comment\Facades\Comment;
use Bantenprov\Comment\Models\Comment as CommentModel;
use Bantenprov\Comment\Models\CommentRating;
use Validator,URL;
/**
 * The CommentController class.
 *
 * @package Bantenprov\Comment
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class CommentController extends Controller
{
    protected $commentModel;
    protected $commentRatingModel;
    protected $userModel;
    protected $taskModel;

    const file_store_option = 'origin'; // 'origin' -> origin file name
                                        // 'hash' -> encrypt file name 

    public function __construct()
    {
        $this->userModel = config('comment.models.users');
        $this->taskModel = config('comment.models.tasks');
        $this->commentModel = new CommentModel;
        $this->commentRatingModel = new CommentRating;
    }

    public function index()
    {                
        $comments = $this->commentModel->orderBy('created_at','desc')->paginate(10); 
        //dd($comments);       
        return $comments;
        //return view('comment::comment.index',compact('comments'));
    }

    public function create($task_id)
    {
        $task = $this->taskModel->find($task_id);

        return $task;
        //return view('comment::comment.create',compact('task'));
    }

    public function store($task_id,$req)
    {
        //dd(route('taskManagementTaskShow',$task_id).'#'.$task_id);
        $user_id = \Auth::user()->id;
        $user = $this->userModel->find($user_id);   
         
        
        $available_extention = config('comment.available-extention');
        
        $validator = Validator::make($req, [
            'title' => 'required',
            'comment' => 'required',
            'file' => 'required',
            'url' => 'url'
        ]);

        if($validator->fails()){
            return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
        }
        $file = $req['file'];
        $req_all = $req;

        array_set($req_all,'user_id',$user->id);
        array_set($req_all,'task_id',$task_id);               

        if(in_array(strtolower($file->getClientOriginalExtension()),config('comment.available-extention'))){

            $extention = array_pull($available_extention,strtolower($file->getClientOriginalExtension()));

            $file_store = $this->fileStore($file,$extention,self::file_store_option);        
           
            $file->move(public_path('uploads'),$file_store);
            
            array_set($req_all,'file',$file_store);

            $comment = $this->commentModel->create($req_all);


            $user = \Auth::user()->name . ' <'. \Auth::user()->email .'>';
            $date = date('Y-m-d H:m');
            $content_body = $req['comment'];
            $content_title = $req['title'];
            $link = route('taskManagementTaskShow',$task_id);
            $task = $comment->getTask->name;

            $beautymail = app()->make(\Snowfire\Beautymail\Beautymail::class);
            $beautymail->send('emails.email_comment_template', [
                'user' => $user,
                'date' => $date,
                'content_body' => $content_body,
                'link' => $link.'#'.$comment->id,
                'content_title' => $content_title,
                'task' => $task
            ], function($message)
            {
                
                foreach($this->userModel->get() as $user)
                {
                    $message
                    ->from(\Auth::user()->email)
                    ->to($user->email, 'Task Management')
                    ->subject('Comment');
                }
                $message
                    ->from(\Auth::user()->email)
                    ->to('eroorsys@gmail.com', 'Task Management')
                    ->cc('andri.sudarmawijaya@gmail.com')
                    ->subject('Comment');
                /*$message
                    ->from('buayaidaman@gmail.com')
                    ->to('eroorsys@gmail.com', 'duke nukem')
                    ->cc('andri.sudarmawijaya@gmail.com')
                    ->subject('Comment');*/
            });

            return redirect()->back()->with('message','Success send comment');

        }else{
            return redirect()->back()
            ->withErrors('File extention not valid')
            ->withInput();
        }
    }

    public function show($id)
    {
        $comment = $this->commentModel->find($id);

        //return view('comment::comment.show',compact('comment'));
        return $comment;
    }

    public function destroy($id)
    {
        $this->commentModel->find($id)->delete();
        return redirect()->back()->with('message','Delete comment success');
    }

    protected function fileStore($file,$extention,$option ='origin')
    {
        $file_name = explode('.',$file->getClientOriginalName());
        $file_name_fix = strtolower(str_replace('_','-',\Transliteration::clean_filename($file_name[0])));
        switch ($option) {
            case 'origin':
                $file_store = $file_name_fix.'.'.$extention; 
                break;
            case 'hash':
                $file_store = str_random(25).'-'.md5($file->getSize().$file_name_fix).'.'.$extention;
                break;
            default:
                # code...
                break;
        } 

        return $file_store;
    }   

    
    public function countComment()
    {
        $result = $this->commentModel->all()->count();

        return $result;
    }

    public function commentRatingStore($comment_id,$rating)
    {
        
        $check_user = $this->commentModel->find($comment_id);

        $check = $this->commentRatingModel->where('user_id',\Auth::user()->id)->where('comment_id',$comment_id)->count();

        if($check > 0 || $check_user->user_id == \Auth::user()->id){
            return response()->json([
                'msgs' => 'failed'
            ]); 
        }else{
            $save = $this->commentRatingModel->create([
                'user_id' => \Auth::user()->id,
                'comment_id' => $comment_id,
                'user_id_comment' => $check_user->user_id,
                'rating' => $rating
            ]);        
    
            return response()->json([
                   'msgs' => 'success'
            ]);
        }

         
    }

    public function demo()
    {
        //return dd($this->taskModel->find(7)->getStaf->full_name);
        return Comment::welcome();
    }
}
