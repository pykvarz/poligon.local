@php
    /** @var \App\Models\BlogPost $item */
@endphp

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                @if($item->is_published)
                    Опубликовано
                @else
                    Черновик
                @endif
            </div>
            <div class="card-body">
                <div class="card-title"></div>
                <div class="card-subtitle mb-2 text-muted"></div>
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a href="#maindata" class="nav-link active" data-toggle="tab" role="tab">Основные данные</a>
                    </li>
                    <li class="nav-item">
                        <a href="#adddata" class="nav-link" role="tab" data-toggle="tab">Доп.данные</a>
                    </li>
                </ul>
                <br>
                <div class="tab-content">
                    <div class="tab-pane active" id="maindata" role="tabpanel">
                        <div class="form-group">
                            <label for="title">Заголовок</label>
                            <input name="title" value="{{ $item->title }}"
                                type="text"
                                id="title"
                                class="form-control"
                               minlength="3"
                               required>
                        </div>
                        <div class="form-group">
                            <label for="content_raw">Статья</label>
                            <textarea name="content_raw" id="content_raw" rows="20">
                                {{ old('content_raw', $item->content_raw) }}</textarea>
                        </div>
                    </div>
                    <div class="tab-pane" id="adddata" role="tabpanel">
                        <div class="form-group">
                            <label for="category_id">Категория</label>
                            <select name="category_id" id="category_id"
                                    class="form-control"
                                    placeholder="Выберите категорию"
                                    required>
                                @foreach($categoryList as $categoryOption)
                                    <option value="{{ $categoryOption->id }}" @if($categoryOption->id == $item->category_id) selected @endif>
                                        {{ $categoryOption->id_title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="slug">Идентификатор</label>
                            <input type="text" name="slug" value="{{ $item->slug }}" id="slug">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
