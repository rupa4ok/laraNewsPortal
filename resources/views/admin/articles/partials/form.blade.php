<label for="">Статус</label>
<select class="form-control" name="published">
    @if (isset($article->id))
        <option value="0" @if ($article->published == 0) selected="" @endif>Не опубликовано</option>
        <option value="1" @if ($article->published == 1) selected="" @endif>Опубликовано</option>
    @else
        <option value="0">Не опубликовано</option>
        <option value="1">Опубликовано</option>
    @endif
</select>

<label for="">Заголовок</label>
<input type="text" class="form-control" name="title" placeholder="Заголовок новости" value="{{$article->title or ""}}" required>

<label for="">Slug</label>
<input class="form-control" type="text" name="slug" placeholder="Автоматическая генерация" value="{{$article->slug or ""}}" >

<label for="">Родительская категория</label>
<select class="form-control" name="parent_id[]" multiple>
    <option value="0">-- без родительской категории --</option>
    @include('admin.articles.partials.categories', ['categories' => $categories])
</select>

<label for="">Краткое описание новости</label>
<textarea name="name" id="" cols="10" rows="5" class="form-control" id="description_short">
    {{$article->description_short ?? ""}}</textarea>

<label for="">Описание новости</label>
<textarea name="name" id="" cols="20" rows="5" class="form-control" id="description_short">
    {{$article->description ?? ""}}</textarea>

<label for="">Мета title</label>
<input class="form-control" type="text" name="slug" placeholder="Мета title" value="{{$article->meta_title or ""}}" >

<label for="">Meta description</label>
<input class="form-control" type="text" name="slug" placeholder="Meta description" value="{{$article->meta_description or ""}}" >

<hr />

<input class="btn btn-primary" type="submit" value="Сохранить">