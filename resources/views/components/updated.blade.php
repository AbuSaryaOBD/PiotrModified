<span class="text-muted">
  {{ empty(trim($slot)) ? 'Added ' : $slot }} {{ $date->diffForHumans() }}
  @if (isset($name))
    by <strong>{{ $name }}</strong>
  @endif
</span>