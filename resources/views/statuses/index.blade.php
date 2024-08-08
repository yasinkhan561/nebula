<?php 
    $firstToolName = App\Models\Tool::find(1)->name; 
    $secondToolName = App\Models\Tool::find(2)->name;
   ?>

@extends('layouts.app')

@section("content")


<div class="row">
    <div class="col-md-12" styes="padding:inherit 20px !important">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible show" role="alert" >
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ session('success') }}
            </div>
        @endif</div>

        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible show" role="alert" >
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>


    <div class=" col-md-6" >
    <div class="panel" >
        <div class="panel-heading">
            <h1 class="panel-title"><strong>Create Status</strong></h1>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" action="{{ route('statuses.store') }}" method="POST" >
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control" name="status" placeholder="Status" required>
                </div>
                <div class="form-group">
                    <div class="col-lg-12">
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>

    <div class="col-md-6">
    <div class="panel">
        <div class="panel-heading bord-btm clearfix pad-all h-100">
            <h1 class="panel-title"><strong>Status  Management</strong></h1>
        </div>
        <div class="panel-body">
            <table class="table table-striped table-vcenter res-table mar-no" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th scope="col" class="px-4 py-3">Status</th>
                        <th scope="col" class="px-4 py-3">{{$firstToolName}} Count</th>
                        <th scope="col" class="px-4 py-3">{{$secondToolName}} Count</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($statuses as $key => $status)
                    
                        @if($status != null)
                            <tr>
                                <td scope="row" class="font-weight-bold text-dark">
                                    {{$status->status}}
                                </td>
                                <td scope="row" class="font-weight-bold text-dark">
                                    {{App\Models\Violation::where("status_id", $status->id)->count()}}
                                </td>
                                <td scope="row" class="font-weight-bold text-dark">
                                {{App\Models\Issue::where("status_id", $status->id)->count()}}
                                </td>

                        
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>

        </div>
     </div>
    </div>
</div>
   

@endsection




