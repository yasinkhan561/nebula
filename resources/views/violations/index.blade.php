@extends('layouts.app')

@section("content")
<div class="panel">
    <div class="panel-heading bord-btm clearfix pad-all h-100">
        <div class="pull-left clearfix">
        <div class="text-lg box-inline mar-hor">{{$tool->name}} Results</div>
            <div class="form-inline box-inline">
                <label for="perPage">Show</label>
                <select class="form-control" id="perPage" onchange="sort_orders()">
                    <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                    <option value="25" {{ request('perPage') == 25 ? 'selected' : '' }} selected>25</option>
                    <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ request('perPage') == 100 ? 'selected' : '' }}>100</option>
                </select>
                <label for="perPage">entries</label>
            </div>
        </div>
        <div class="box-inline mar-lft">
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#bulk-status-update">Bulk Status Update</button>
        </div>
        <div class="pull-right clearfix">
            <form id="sort_orders" action="{{ route('violations.export') }}" method="GET">
                <div class="box-inline pad-rgt pull-left">
                    <div class="select" style="min-width: 300px;">
                        <select class="form-control demo-select2" name="website_id" id="website_id" onchange="sort_orders()">
                            <option value="">Filter by website</option>
                            @foreach($websites as $website)
                                <option value="{{ $website->id }}">{{ $website->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" name="exportSortBy" id="exportSortBy" value="id">
                    <input type="hidden" name="exportSortOrder" id="exportSortOrder" value="asc">
                </div>
                <div class="box-inline pad-rgt pull-left">
                    <button type="submit" class="btn btn-primary">Export Results</button>
                </div>

            </form>
        </div>
    </div>
    <div class="panel-body">
        <table class="table table-striped res-table mar-no pad-no" cellspacing="0" width="100%">
            <thead>
                <tr>
                <th >Select</th>
                <th class="clickable"><span  onclick="sortTable('website_id')">Website <i class="sort-icon" id="sort-website_id"></i></span></th>
                <th class="clickable"><span  onclick="sortTable('batch')">Batch <i class="sort-icon" id="sort-batch"></i></span></th>
                <th class="clickable"><span  onclick="sortTable('page_id')">Page <i class="sort-icon" id="sort-page_id"></i></span></th>
                <th class="clickable"><span  onclick="sortTable('violation')">Violation <i class="sort-icon" id="sort-violation"></i></span></th>
                <th class="clickable"><span  onclick="sortTable('description')">Description <i class="sort-icon" id="sort-description"></i></span></th>
                <th class="clickable"><span  onclick="sortTable('status_id')">Status <i class="sort-icon" id="sort-status_id"></i></span></th>
                <th class="clickable"><span  onclick="sortTable('impact')">Impact <i class="sort-icon" id="sort-impact"></i></span></th>
                <th>Tags</th>
                <th class="clickable"><span  onclick="sortTable('created_at')">Date <i class="sort-icon" id="sort-created_at"></i></span></th>
                </tr>
            </thead>
            <tbody id="violations-table">
            </tbody>
        </table>
        <div class="clearfix">
            <div class="pull-right" id="pagination-links">

            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="bulk-status-update" tabindex="-1" role="dialog" aria-labelledby="bulkStatusUpdate" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <form >
            <div class="modal-header">
                <h4 class="modal-title" id="bulkStatusUpdate">Bulk Status Update</h4>
            </div>

            <div class="modal-body" style="min-height:300px">
           
                <div class="pad-hor">
                    <div class="select"  style="width:100%">
                        <select class="form-control demo-select2" name="bulkStatusId" id="bulkStatusId">
                            <option value="">choose status</option>
                            @foreach($statuses as $status)
                                <option value="{{ $status->id }}">{{ $status->status }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" onClick="bulkStatusUpdate()"  class="btn btn-primary btn-ok">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    let currentPage = 1;
    let currentSortOrder = 'asc';
    let currentSortBy = '';

    function sort_orders() {
        const website_id = document.getElementById('website_id').value;
        const perPage = document.getElementById('perPage').value;

        $.ajax({
            url: "{{ route('violations.index') }}",
            type: "GET",
            data: {
                website_id: website_id,
                sortBy: currentSortBy,
                sortOrder: currentSortOrder,
                perPage: perPage,
                page: currentPage
            },
            success: function(response) {
                updateTable(response.violations.data, response.statuses);
                updatePagination(response.violations);
                updateSortIcons();
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }



    function sortTable(column) {
        if (currentSortBy === column) {
            currentSortOrder = currentSortOrder === 'asc' ? 'desc' : 'asc';
        } else {
            currentSortOrder = 'asc';
        }
        currentSortBy = column;
        $("#exportSortBy").val(column);
        $("#exportSortOrder").val(currentSortOrder);
        sort_orders();
    }

    function updateSortIcons() {
        const icons = document.querySelectorAll('.sort-icon');
        icons.forEach(icon => {
            icon.className = 'sort-icon'; // Reset all icons
        });

        const sortIcon = document.getElementById(`sort-${currentSortBy}`);
        if (sortIcon) {
            sortIcon.className = `sort-icon fa fa-sort-${currentSortOrder === 'asc' ? 'alpha-asc' : 'alpha-desc'}`;
        }
    }






    function updateTable(violations, statuses) {
        let rows = '';
        if (violations.length === 0) {
            rows = `
                <tr>
                    <td colspan="9" class="dataTables_empty">No data available in table</td>
                </tr>
            `;
        } else {


            violations.forEach(violation => {

                let statusOptions = '';
                statuses.forEach(status => {
                    statusOptions += `
                        <option value="${status.id}" ${status.id == violation.status_id ? 'selected' : ''}>${status.status}</option>
                    `;
                });




                rows += `
                <tr>
                        <td><input type="checkbox" name="selected_issues[]" value="${violation.id}"></td>
                        <td>${violation.page?.website ? violation.page.website.title : 'N/A'}</td>
                        <td>${violation.page?.batch}</td>
                        <td><a href="${violation.page?.url}">View Page</a></td>
                        <td>${violation.violation}</td>
                        <td>${violation.description}</td>
                         <td>
                            <select class="form-control status-dropdown" data-issue-id="${violation.id}" onchange="updateViolationStatus(this.getAttribute('data-issue-id'), this.value)">
                               ${statusOptions}
                            </select>
                        </td>
                        <td>${violation.impact}</td>
                        <td>${JSON.parse(violation.tags || '[]').join(",")}</td>
                        <td>${violation.page?.scan_time}</td>
                    </tr>
                `;
            });
        }
        document.getElementById('violations-table').innerHTML = rows;
    }

    function updatePagination(pagination) {
        let paginationLinks = '';
        let startPage = Math.max(1, pagination.current_page - 3);
        let endPage = Math.min(pagination.last_page, pagination.current_page + 3);

        // Add a link to the first page
        paginationLinks += `<li class="page-item ${pagination.current_page === 1 ? 'disabled' : ''}">
            <a class="page-link" href="#" onclick="changePage(1); return false;">First</a>
        </li>`;
        if (pagination.current_page !== pagination.last_page){
            paginationLinks += `<li class="page-item">
            <a class="page-link" href="#" onclick="changePage(${pagination.current_page + 1}); return false;">Next</a>
        </li>`;
        }
        

        for (let i = startPage; i <= endPage; i++) {
            paginationLinks += `<li class="page-item ${i === pagination.current_page ? 'active' : ''}">
                <a class="page-link" href="#" onclick="changePage(${i}); return false;">${i}</a>
            </li>`;
        }

        if (pagination.current_page !== 1){
            paginationLinks += `<li class="page-item">
            <a class="page-link" href="#" onclick="changePage(${pagination.current_page - 1}); return false;">Previous</a>
        </li>`;
        }

        // Add a link to the last page
        paginationLinks += `<li class="page-item ${pagination.current_page === pagination.last_page ? 'disabled' : ''}">
            <a class="page-link" href="#" onclick="changePage(${pagination.last_page}); return false;">Last</a>
        </li>`;

        document.getElementById('pagination-links').innerHTML = `<ul class="pagination">${paginationLinks}</ul>`;
    }


    function updateViolationStatus(violationId, statusId) {
     
        $.ajax({
            url: "{{ route('violations.updateStatus') }}",
            type: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                violationId: violationId,
                statusId: statusId,
            },
            success: function(response) {
                if(response){
                    sort_orders();
                    showAlert("success", 'Status updated successfully!');
                }
            },
            error: function(xhr, status, error) {
                showAlert("error", 'something went wrong!');
            }
        });
    }

    function changePage(page) {
        currentPage = page;
        sort_orders();
    }
    $(document).ready(function() {
    sort_orders();
});


function bulkStatusUpdate() {
       
var statusId = $('#bulkStatusId').val();
var issueIds = $('input[name="selected_issues[]"]:checked').map(function(){
    return $(this).val();
}).get();


 
 if(issueIds.length == 0){
    showAlert("danger", 'Please select atleast one issue!');
    return;
 }

 $('#bulk-status-update').modal('hide');
 $('#bulkStatusId').val('');

$.ajax({
    url: "{{ route('violations.bulkUpdate') }}",
    type: "POST",
    data: {
        _token: $('meta[name="csrf-token"]').attr('content'),
        issueIds,
        statusId,
    },
    success: function(response) {
        if(response){
            sort_orders();
            showAlert("success", 'Status updated successfully!');
        }
    },
    error: function(xhr, status, error) {
        showAlert("danger", 'something went wrong!');
    }
});
 }
</script>
</script>
@endsection
