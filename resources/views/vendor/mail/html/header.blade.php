<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'FunaAkatale')
<img src="https://res.cloudinary.com/ivhfizons/image/upload/v1642777098/notification-logo.png" class="logo" alt="Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
