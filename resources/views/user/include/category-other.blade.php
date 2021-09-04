<div class="sidebar-widget tags-widget">
    <h3 class="widget-title">Category</h3>
    <ul class="tag-list clearfix">
        @foreach ($data['category'] as $item)
        <li><a href="{{route('other.shop',['category' => $item->id])}}">{{$item->title}}</a></li>
        @endforeach
    </ul>
</div>
