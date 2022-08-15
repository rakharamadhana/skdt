@if(!empty($breadcrumb))
    <nav class="breadcrumb" aria-label="breadcrumbs">
        <ul>
    @foreach($breadcrumb as $index =>  $item)
        @if($index == 0)
            <li>
                <a class="target-link" href="dashboard#{{$item->link}}">
                    <span class="icon">
                        <i class="fa fa-home"></i>
                    </span>
                    {{$item->name}}
                </a>
            </li>
        @else
            <li>
                <a class="target-link" href="dashboard#{{$item->link}}">
                    <span>{{$item->name}}</span>
                </a>
            </li>
        @endif
    @endforeach
        </ul>
    </nav>
@endif