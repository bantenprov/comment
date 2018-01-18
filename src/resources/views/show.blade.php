@extends('layouts/default') 
{{-- Page title --}} 
@section('title') 
{{ $title }} 
@stop 
{{-- local styles --}} 
@section('header_styles') 
<link href="{{asset('css/alertmessage.css')}}" rel="stylesheet">
@stop {{-- Page Header--}} 


@section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>{{ $title }}</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('taskManagementCommentIndex') }}">
                <i class="fa ti-arrow-circle-left"></i> Back
            </a>
        </li>
    </ol>
</section>
@stop {{-- Page content --}} 

@section('content') 

<div class="col-sm-12 col-md-12">    
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                <i class="ti-notepad"></i> {{ $comment->title }}
            </h3>
        </div>
        <div class="panel-body">
            <dl class="dl-horizontal">
                <dt>User :</dt>
                <dd>
                    {{ $comment->getUser->name }}
                </dd>
                <dt>Task name :</dt>
                <dd>
                    <a href="{{ route('taskManagementTaskShow',$comment->getTask->id) }}">{{ $comment->getTask->name }}</a>
                </dd>  
                <dt>Url :</dt>
                <dd>
                    {{ $comment->url }}
                </dd>   
                <dt>File :</dt>
                <dd>
                    {{ $comment->file }} | <a href="{{ url('/uploads/'.$comment->file) }}" target="_blank" >view file</a>
                </dd>            
            </dl>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="panel ">
        <div class="panel-heading">
            <h3 class="panel-title">
                <i class="ti-notepad"></i> Comment
            </h3>
            <span class="pull-right">
                <i class="fa fa-fw ti-angle-up clickable"></i>
            </span>
        </div>
        <div class="panel-body">
            <div class="alert-message alert-message-default">
                <h4>
                    {{ $comment->title }}
                </h4>
                <p>
                    {{ $comment->comment }}
                </p>
            </div>
        </div>
    </div>
</div>
@stop {{-- local scripts --}} 


@section('footer_scripts') @stop
