@php /** @var \App\Models\BlogCategory $item */ @endphp
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title"></div>
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a href="#maindata" data-toggle="tab" role="tab" class="nav-link active">Основные данные</a>
                    </li>
                </ul>
                <br>
                <div class="tab-content">
                    <div id="maindata" role="tabpanel" class="tab-pane active">
                        <div class="form-group">
                            <lable for="title">Заголовок</lable>
                            <input type="text" value="{{$item->title}}" name="title" id="title" required class="form-control">
                        </div>
                        <div class="form-group">
                            <lable for="slug">URL</lable>
                            <input type="text" value="{{$item->slug}}"  name="slug" id="slug" class="form-control">
                        </div>
                        <div class="form-group">
                            <lable for="parent_id">Родитель</lable>
                            <select required name="parent_id" id="parent_id" class="form-control" placeholder="Виберите категория">
                                @foreach($categoryList as $catOption)
                                <option value="{{$catOption->id}}"
                                        @if($catOption->id == $item->parent_id) selected @endif
                                        @if($catOption->id == $item->id) disabled @endif
                                >
                                    {{$catOption->id_title}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <lable for="description">Описание</lable>
                            <textarea name="description"
                                    rows="5"
                                     id="description"
                                     class="form-control" >{{ old('description', $item->description) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>