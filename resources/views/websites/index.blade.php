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


    <div class=" col-md-4" >
    <div class="panel" >
        <div class="panel-heading">
            <h1 class="panel-title"><strong>Create Website</strong></h1>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" action="{{ route('websites.store') }}" method="POST" >
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control" name="title" placeholder="Title" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="url"  placeholder="Website Url">
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

    <div class="col-md-8">
    <div class="panel">
        <div class="panel-heading bord-btm clearfix pad-all h-100">
            <h1 class="panel-title"><strong>Websites</strong></h1>
        </div>
        <div class="panel-body">
            <table class="table table-striped table-vcenter res-table mar-no" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th scope="col" class="px-4 py-3">Title</th>
                        <th scope="col" class="px-4 py-3">Url</th>
                        <th width="10%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($websites as $key => $website)
                    
                        @if($website != null)
                            <tr>
                                <td scope="row" class="font-weight-bold text-dark">
                                    {{$website->title}}
                                </td>
                                <td scope="row" class="font-weight-bold text-dark">
                                    {{$website->url}}
                                </td>
                               
                                <td>
                                    <a class="btn btn-primary" onclick="confirm_modal('{{route('websites.destroy', $website->id)}}');"><i class="fa fa-trash"></i></a>
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




