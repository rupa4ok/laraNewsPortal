@foreach ($categories as $category)
    <option value="{{$category->id ?? ""}}"
    @isset($article->id)
        @foreach ($article->categories as $category_article)
            @if ($category->id == $category_article->id)
                selected="selected"
            @endif
        @endforeach
    @endisset
    >
        {!! $delimiter ?? "" !!}{{$article->title ?? ""}}
    </option>
    @if (count($category->children) > 0)
        @include('admin.articles.partials.categories', [
            'categories' => $category->children,
            'delimiter' => ' - ' . $delimiter
        ])
    @endif
@endforeach