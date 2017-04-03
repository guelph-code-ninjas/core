@foreach ($tree as $node)

@if ($node->isTree())

<div> {{ $node->getName() }} is a directory </div>
@else

<div> {{ $node->getName() }} </div>
@endif

@endforeach
