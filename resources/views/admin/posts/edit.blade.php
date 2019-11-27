@extends('admin.layout')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>


@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Изменить статью
        <small>приятные слова..</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      {{Form::open([
        'route'=>['posts.update', $post->id],
        'method'=> 'put',
        'files'=> true
        ])}}

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Изменяем статью</h3>
          @include('admin.errors')
        </div>
        <div class="box-body">
          <div class="col-md-6">
            <div class="form-group">
              <label for="exampleInputEmail1">Название</label>
              <input type="text" class="form-control" name="title" id="exampleInputEmail1" placeholder="" value="{{$post->title}}">
            </div>
            
            <div class="form-group">
              <img src="{{$post->getImage()}}" alt="" class="img-responsive" width="200">
              <label for="exampleInputFile">Лицевая картинка</label>
              <input type="file" id="exampleInputFile" name="image">

              <p class="help-block">Какое-нибудь уведомление о форматах..</p>
            </div>
            <div class="form-group">
              <label>Категория</label>
              {{Form::select('category_id', $categories, $post->getCategoryId(),['class'=>'form-control select2'])}}
              
            </div>
            <div class="form-group">
              <label>Теги</label>
              {{Form::select('tags[]', $tags, $post->tags->pluck('id')->all(),['class'=>'form-control select2', 'multiple'=>'multiple', 'data-placeholder'=>'Выберите теги'])}}
             
            </div>
            <!-- Date -->
            <div class="form-group">
              <label>Дата:</label>

              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input class="form-control" type="date" name="date" value="{{$post->date}}" id="example-date-input">
                </div>
            </div>
           
              <!-- /.input group -->
            

            <!-- checkbox -->
            <div class="form-check">
              <label>
                {{Form::checkbox('is_featured', '1', $post->is_featured, ['class'=>'form-check-input'])}}
              </label>
              <label>
                Рекомендовать
              </label>
            </div>

            <!-- checkbox -->
            <div class="form-check">
              <label>
              {{Form::checkbox('status', '1', $post->status, ['class'=>'form-check-input'])}}
          
              </label>
              <label>
                Черновик
              </label>
            </div>
            <div class="col-md-12">
            <div class="form-group">
              <label for="exampleInputEmail1">Описание</label>
              <textarea name="description" id="" cols="30" rows="10" class="form-control">{{$post->description}}</textarea>
          </div>
          </div> 
            <div class="form-group">
              <label for="exampleInputEmail1">Полный текст</label>
              <textarea name="content" id="" cols="30" rows="10" class="form-control">{{$post->content}}</textarea>
          </div>
        </div>
      </div>
        <!-- /.box-body -->
        <div class="box-footer">
        <a href="{{route('posts.index')}}" class="btn btn-default">Назад</a>
          <button class="btn btn-success pull-right">Добавить</button>
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->
{{Form::close()}}
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection