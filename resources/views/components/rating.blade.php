@php
    $fullStars = floor($rating);
    $halfStar = ($rating - $fullStars) >= 0.5 ? 1 : 0;
    $emptyStars = 5 - $fullStars - $halfStar;
@endphp

<div class="rating">
    @for ($i = 1; $i <= $fullStars; $i++)
        <span class="star full">★</span>
    @endfor

    @if ($halfStar)
        <span class="star half">½</span>
    @endif

    @for ($i = 1; $i <= $emptyStars; $i++)
        <span class="star empty">☆</span>
    @endfor
</div>