<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="/frontend/img/logo.png" class="logo" alt="Diablo 2 Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
