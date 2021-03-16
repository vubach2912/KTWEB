<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{ url('/frontend/img/logo.png') }}" class="logo" alt="Kiem The Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
