@extends('layouts.app')

@section("content")
<div class="panel">
    <div class="panel-heading bord-btm clearfix pad-all h-100">
        <div class="pull-left clearfix">
            <div class="text-lg box-inline mar-hor">Pages</div>
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
        <div class="pull-right clearfix d-none" style="display:none">
            <form id="sort_orders" action="{{ route('issues.export') }}" method="GET">
                <div class="box-inline pad-rgt pull-left">
                    <div class="select" style="min-width: 300px;">
                        <select class="form-control demo-select2" name="website_id" id="website_id" onchange="sort_orders()">
                            <option value="">Filter by website</option>
                            @foreach($websites as $website)
                                <option value="{{ $website->id }}">{{ $website->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="box-inline pad-rgt pull-left">
                    <button type="submit" class="btn btn-primary">Export</button>
                </div>
                <div class="box-inline pad-rgt pull-left">
                    <a class="btn btn-primary" href="{{ route('issues.import') }}">Import</a>
                </div>
            </form>
        </div>
    </div>
    <div class="panel-body">
        <table class="table table-striped res-table mar-no" cellspacing="0" width="100%">
        <thead>
                <tr>
                    <th>Website</th>
                    <th>Batch</th>
                    <th>URL</th>
                    <th>Nodes</th>
                    <th>Critical</th>
                    <th>Serious</th>
                    <th>Moderate</th>
                    <th>Minor</th>
                    <th>Score</th>
                    <th>Aria</th>
                    <th>Forms</th>
                    <th>Name Role Value</th>
                    <th>Scanned At</th>
                </tr>
            </thead>
            <tbody id="pages-table">
                @include('pages.partials.page-rows', ['pages' => $pages])
            </tbody>
        </table>
        <div class="clearfix">
            <div class="pull-right" id="pagination-links">
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    let currentPage = 1;

    function sort_orders() {
        const website_id = document.getElementById('website_id').value;
        const perPage = document.getElementById('perPage').value;

        $.ajax({
            url: "{{ route('pages.index') }}",
            type: "GET",
            data: {
                website_id: website_id,
                perPage: perPage,
                page: currentPage
            },
            success: function(response) {
                updateTable(response.pages.data);
                updatePagination(response.pages);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    function updateTable(pages) {
    let rows = '';
    if (pages.length === 0) {
        rows = `
            <tr>
                <td colspan="14" class="dataTables_empty">No data available in table</td>
            </tr>
        `;
    } else {
        pages.forEach(page => {
            rows += `
                <tr>
                    <td>${page.website ? page.website.title : 'N/A'}</td>
                    <td>${page.batch}</td>
                    <td><a href="${page.url}">View Page</a></td>
                    <td>${page.nodes}</td>
                    <td>${page.critical}</td>
                    <td>${page.serious}</td>
                    <td>${page.moderate}</td>
                    <td>${page.minor}</td>
                    <td>${page.score}</td>
                    <td>${page.aria}</td>
                    <td>${page.forms}</td>
                    <td>${page.name_role_value}</td>
                    <td>${new Date(page.scan_time).toLocaleDateString('en-US', { month: '2-digit', day:'2-digit', year:'4-digit' })}</td>
                </tr>
            `;
        });
    }
    document.getElementById('pages-table').innerHTML = rows;
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

    function changePage(page) {
        currentPage = page;
        sort_orders();
    }
    $(document).ready(function() {
    sort_orders();
});
</script>
@endsection
