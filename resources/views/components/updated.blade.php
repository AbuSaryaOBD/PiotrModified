<span class="text-muted">
  {{ empty(trim($slot)) ? 'Added ' : $slot }} {{ $date->diffForHumans() }}
  @if (isset($userId))
    by <a href="{{ route('users.show', ['user' => $userId]) }}">{{ $name }}</a>
  @else
    by <strong>{{ $name }}</strong>
  @endif
</span>