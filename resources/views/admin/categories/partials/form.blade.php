<label for="">Статус</label>
<select class="form-control" name="published" id="">
    @if (isset($category->id))
        <option value="0" @if ($category->published == 0) selected = "" @endif>Не опубликовано</option>
        <option value="1" @if ($category->published == 1) selected = "" @endif>Опубликовано</option>
    @else
        <option value="0">Не опубликовано</option>
        <option value="1">Опубликовано</option>
    @endif
</select>