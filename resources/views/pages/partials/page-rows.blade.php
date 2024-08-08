@foreach ($pages as $page)
<tr>
  <td>{{ $page->website ? $page->website->title : 'N/A' }}</td>
  <td>{{ $page->batch }}</td>
  <td><a href="{{ $page->url }}">View Page</a></td>
  <td>{{ $page->nodes }}</td>
  <td>{{ $page->critical }}</td>
  <td>{{ $page->serious }}</td>
  <td>{{ $page->moderate }}</td>
  <td>{{ $page->minor }}</td>
  <td>{{ $page->score }}</td>
  <td>{{ $page->aria }}</td>
  <td>{{ $page->forms }}</td>
  <td>{{ $page->name_role_value }}</td>
  <td>{{ (new DateTime($page->scan_time))->format('m/d/Y') }}</td>
</tr>
@endforeach
