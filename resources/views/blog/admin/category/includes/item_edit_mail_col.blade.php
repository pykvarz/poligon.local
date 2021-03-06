@php
    /** @var \App\Models\BlogCategory $item */
@endphp
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a href="#maindata" class="nav-link active" data-toggle="tab" role="tab">Основные данные</a>
                        </li>
                    </ul>
                    <br>
                    <div class="tab-content">
                        <div class="tab-pane active" id="maindata" role="tabpanel">
                            <div class="form-group">
                                <label for="title">Заголовок</label>
                                <input type="text" name="title" value="{{$item->title}}"
                                id="title"
                                class="form-control"
                                minlength="3"
                                required>
                            </div>

                            <div class="form-group">
                                <label for="slug">Идентификатор</label>
                                <input type="text" value="{{$item->slug}}"
                                id="slug"
                                class="form-control"
                                name="slug"
                                >
                            </div>

                            <div class="form-group">
                                <label for="paren_id">Родитель</label>
                                <select name="parent_id" id="parent_id"
                                class="form-control"
                                placeholder="Выберите категорию"
                                required>
                                @foreach($categoryList as $categoryOption)
                                        <option value="{{ $categoryOption->id }}" @if($categoryOption->id == $item->parent_id) selected @endif>
                                            {{$categoryOption->id_title}}
                                        </option>
                                @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="description">Описание</label>
                                <textarea name="description" id="description" rows="3" class="form-control">
                                    {{ $item->description }}
                                </textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
