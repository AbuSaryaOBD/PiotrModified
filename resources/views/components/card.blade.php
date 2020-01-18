<div class="card mt-3">
  <div class="card-header">
    <h5 class="card-title">{{ $title }}</h5>
    <small class="card-subtitle">{{ $subTitle }}</small>
  </div>
  <div class="card-body p-1">
    <ul class="list-group listgroup-flush">
      @if (is_a($items, 'Illuminate\Support\Collection'))
        @foreach ($items as $item)
          <li class="list-group-item px-2">
              {{ $item }}
          </li>
        @endforeach
      @else
        {{ $items }}
      @endif
    </ul>
  </div>
</div>