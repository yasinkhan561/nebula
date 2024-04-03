@extends('layouts.app')

@section("content")

<div class="panel">
        <div class="panel-heading bord-btm clearfix pad-all h-100">
          
            <h2 class="panel-title pull-left pad-no">Issues</h2>
               
     
            <div class="pull-right clearfix">
           
            
                <form class="" id="sort_orders" action="{{ route('export') }}" method="GET">

                
                  
                    <div class="box-inline pad-rgt pull-left">
                        <div class="select" style="min-width: 300px;">
                            <select class="form-control demo-select2" name="website" id="website" onchange="sort_orders()">
                                <option value="">Filter by website</option>
                                @foreach($websites as  $website)
                                    <option value="{{ $website->id }}">{{ $website->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- <div class="box-inline pad-rgt pull-left">
                        <div class="select" style="min-width: 300px;">
                            <select class="form-control demo-select2" name="delivery_status" id="delivery_status" onchange="sort_orders()">
                                <option value="">Filter by Deliver Status</option>
                                <option value="pending"   @isset($delivery_status) @if($delivery_status == 'pending') selected @endif @endisset>Pending</option>
                                <option value="on_review"   @isset($delivery_status) @if($delivery_status == 'on_review') selected @endif @endisset>On review</option>
                                <option value="on_delivery"   @isset($delivery_status) @if($delivery_status == 'on_delivery') selected @endif @endisset>On delivery</option>
                                <option value="delivered"   @isset($delivery_status) @if($delivery_status == 'delivered') selected @endif @endisset>Delivered</option>
                            </select>
                        </div>
                    </div>
                    <div class="box-inline pad-rgt pull-left">
                        <div class="" style="min-width: 200px;">
                            <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="{{ 'Type Order code & hit Enter' }}">
                        </div>
                    </div> -->
                    <div class="box-inline pad-rgt pull-left">
                      
                        <button type="submit" class="btn btn-primary">
                            Export
                        </button>
                        
                    </div>
                    <div class="box-inline pad-rgt pull-left">
                      
                        <a type="button" class="btn btn-primary" href="{{route('import')}}">
                            Import
                        </a>
                        
                    </div>
                </form>
            </div>
        </div>
        <div class="panel-body">
            <table class="table table-striped res-table mar-no" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th scope="col" class="px-4 py-3" style="width:8%;">Website</th>
                        <th scope="col" class="px-4 py-3">Batch</th>
                        <th scope="col" class="px-4 py-3">Page</th>
                        <th scope="col" class="px-4 py-3" style="width:15%;">Url</th>
                        <th scope="col" class="px-4 py-3" style="width:5%;">Issue Link</th>
                        <th scope="col" class="px-4 py-3">Description</th>
                        <th scope="col" class="px-4 py-3" style="width:9%;">Criterion</th>
                        <th scope="col" class="px-4 py-3">Element</th>
                        <th scope="col" class="px-4 py-3">Complexity</th>
                        <th scope="col" class="px-4 py-3" style="width:3%;">Severity</th>
                        <th scope="col" class="px-4 py-3" style="width:6%;">Check Type</th>
                        <th scope="col" class="px-4 py-3" style="width:4%;">Responsibility</th>
                        <th scope="col" class="px-4 py-3">Issue Reference</th>
                        <th scope="col" class="px-4 py-3" style="width:8%;">Date</th>
                        <!-- <th width="10%">Options</th> -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($issues as $key => $issue)
                    
                        @if($issue != null)
                            <tr>
                                <th scope="row" class="px-4 py-2 font-weight-bold text-dark">
                                @php
                                    $website_name = \App\Models\Website::where('id', $issue->website)->first();
                                @endphp
                                    {{$website_name->title}}
                                </th>
                                <th scope="row" class="px-4 py-2 font-weight-bold text-dark">
                                    {{$issue->batch}}
                                </th>
                                <td class="px-4 py-2">
                                    {{$issue->page}}
                                </td>
                                <td class="px-4 py-2 font-weight-bold text-dark">
                                    <div class="d-flex align-items-center">
                                        <a href="{{$issue->url}}">{{$issue->url}}</a>
                                    </div>
                                </td>
                                <td class="px-4 py-2 font-weight-bold text-dark">{{$issue->issue_link}}</td>
                                <td class="px-4 py-2 font-weight-bold text-dark">{{$issue->description}}</td>
                                <td class="px-4 py-2 font-weight-bold text-dark">
                                    {{$issue->criterion}}
                                </td>
                                <td class="px-4 py-2 font-weight-bold text-dark">
                                    {{$issue->element}}
                                </td>
                                <td class="px-4 py-2"> {{$issue->complexity}}</td>
                                <td class="px-4 py-2 font-weight-bold text-dark"> {{$issue->severity}}</td>
                                <td class="px-4 py-2 font-weight-bold text-dark"> {{$issue->check_type}}</td>
                                <td class="px-4 py-2 font-weight-bold text-dark"> {{$issue->responsibility}}</td>
                                <td class="px-4 py-2 font-weight-bold text-dark"> {{$issue->issue_reference}}</td>
                                <td class="px-4 py-2 font-weight-bold text-dark" > {{$issue->date}}</td>

                                <!-- <td>
                                    <div class="btn-group dropdown">
                                        <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                            Actions <i class="dropdown-caret"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li><a href="{{ route('issues', encrypt($issue->id)) }}">View</a></li>
                                            <li><a href="{{ route('issues', $issue->id) }}">Download Invoice</a></li>
                                            <li><a >Delete</a></li>
                                        </ul>
                                    </div>
                                </td> -->
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            <div class="clearfix">
                <div class="pull-right">
                    
                </div>
            </div>
        </div>
    </div>

       

@endsection


@section('script')
    <!-- <script type="text/javascript">
        function sort_orders(el){
            $('#sort_orders').submit();
        }
    </script> -->
@endsection


