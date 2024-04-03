@extends('layouts.app')

@section("content")

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

    <div class="panel col-md-8 col-md-offset-2 " style="margin-top:50px;padding-top:30px">
        <div class="panel-heading">
            <h1 class="panel-title"><strong>Import Issues</strong></h1>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" action="{{ route('import.excel') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="select form-group" >
                            <select class="form-control demo-select2" name="website" id="website"  required>
                                <option value="">Choose website</option>
                                @foreach($websites as  $website)
                                    <option value="{{ $website->id }}">{{ $website->title }}</option>
                                @endforeach

                            </select>
                </div>
        
                <div class="form-group">
                    <input type="file" class="form-control" name="bulk_file" required>
                </div>
                <div class="form-group">
                    <div class="col-lg-12">
                        <button class="btn btn-primary" type="submit">Import</button>
                    </div>
                </div>
            </form>
        </div>
    </div>




@endsection