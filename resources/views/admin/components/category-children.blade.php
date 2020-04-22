@foreach ($term_taxonomy->get_term_by_parent($parent, 'category') as $childCategory)
    <ul class="children">
        <li>
            <label class="kt-checkbox">
                <input name="post_category[]" type="checkbox"
                       value="{{$childCategory['term_id']}}"> {{$childCategory['name']}}
                <span></span>
            </label>
            @if($childCategory['parent'] != 0)
                @include('admin.components.category-children', ['parent' => $childCategory['term_id']])
            @endif
        </li>
    </ul>
@endforeach
