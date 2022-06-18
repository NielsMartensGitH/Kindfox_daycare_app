<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{ asset('assets/img/Kindfoxlogo.png')}}" width="300px">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
