@foreach ($violations as $violation)
<tr>
  <td>{{ $violation->page->website ? $violation->page->website->title : 'N/A' }}</td>
  <td>{{ $violation->page->batch }}</td>
  <td><a href="{{ $violation->page->url }}">{{ "Page Link" }}</a></td>
  <td>{{ $violation->violation }}</td>
  <td>{{ $violation->description }}</td>
  <td>{{ $violation->impact }}</td>
  <td>{{ !empty($violation->tags) ? implode(', ', json_decode($violation->tags)) : null }}</td>
  <td>{{ $violation->page->scan_time }}</td>
</tr>
@endforeach
