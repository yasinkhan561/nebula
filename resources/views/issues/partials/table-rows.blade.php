@foreach ($issues as $issue)
<tr>
 <td> <input type="checkbox" name="selected_issues[]" value="{{ $issue->id }}"></td>
  <td>{{ $issue->website ? $issue->website->title : 'N/A' }}</td>
  <td>{{ $issue->batch }}</td>
  <td><a href="{{ $issue->url }}">{{ $issue->page }}</a></td>
  <td><a href="{{ $issue->issue_link }}">{{ $issue->issue_reference }}</a></td>
  <td>{{ $issue->description }}</td>
  <td>{{ $issue->criterion }}</td>
  <td>{{ $issue->element }}</td>
  <td>{{ $issue->complexity }}</td>
  <td>{{ $issue->severity }}</td>
  <td>{{ $issue->check_type }}</td>
  <td>{{ $issue->responsibility }}</td>
  <td>{{ date('Y-m-d', strtotime($issue->date)) }}</td>
</tr>
@endforeach