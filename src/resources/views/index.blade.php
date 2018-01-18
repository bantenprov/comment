@extends('layouts/default') 
{{-- Page title --}} 
@section('title') 
{{ $title }} 
@stop {{-- local styles --}} 
@section('header_styles') 
@stop 
{{-- Page Header--}} 
@section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>{{ $title }}</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('index')}}">
                <i class="fa fa-fw fa-home"></i> Dashboard
            </a>
        </li>
        <li class="active">
            Comment
        </li>
    </ol>
</section>
@stop {{-- Page content --}} 

@section('content') 

<div>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(session()->has('message'))
    <li>{{ session()->get('message') }}</li>
@endif
</div>   

<div class="row">
    <div class="col-lg-12">
        <div class="panel ">
            <div class="panel-heading">
                <h3 class="panel-title">
                                <i class="ti-list"></i> Comment List
                            </h3>
                <span class="pull-right">
                                    <i class="fa fa-fw ti-angle-up clickable"></i>
                                </span>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="mytable" class="table table-bordred table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Comment Title</th>
                                <th>Task name</th>                                
                                <th>View</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($comments as $key => $comment)                            
                                <tr>
                                    @if($comments->currentPage() == 1)
                                        <td>{{ $key+1*$comments->currentPage() }}</td>
                                    @else
                                        <td>{{ $key+$comments->currentPage()*$comments->perPage()-$comments->perPage()+1 }}</td>
                                    @endif
                                    <td>{{ $comment->title }}</td>   
                                    <td>{{ $comment->getTask->name }}</td>         
                                    <td width="50px"> 
                                        <p>
                                            <a class="btn btn-primary btn-xs" href="{{ route('taskManagementCommentShow',$comment->id) }}" data-toggle="modal" data-placement="top"><span class="fa fa-fw ti-eye"></span></a>
                                        </p>
                                    </td>
                                    <td width="50px"> 
                                        <p>
                                            <a class="btn btn-danger btn-xs" href="{{ route('taskManagementCommentDestroy',$comment->id) }}" data-toggle="modal" data-placement="top"><span class="fa fa-fw fa-times"></span></a>
                                        </p>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">No results</td>
                                </tr>
                            @endforelse                           
                        </tbody>
                    </table>
                </div>
                {{ $comments->links() }}
            </div>
        </div>
    </div>
</div>

@stop {{-- local scripts --}} 


@section('footer_scripts') @stop
