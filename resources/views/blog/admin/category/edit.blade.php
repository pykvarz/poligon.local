@extends('layouts.base');

@section('content')
    @php
        /** @var \App\Models\BlogCategory $item */
    @endphp
    <form action="{{ route('blog.admin.categories.update', $item->id) }}" method="POST">
        @method('PATCH')
        @csrf
        <div class="container">
            @php
            /** @var \Illuminate\Support\ViewErrorBag $errors */
            @endphp
            @if($errors->any())
            <div class="row justify-content-center">
                <div class="col-md-11">
                    <div class="alert alert-danger" role="alert">
                        <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">x</span>
                        </button>
                        {{$errors->first()}}
                    </div>
                </div>
            </div>
            @endif
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @include('blog.admin.category.includes.item_edit_mail_col')
                </div>
                <div class="col-md-3">
                    @include('blog.admin.category.includes.item_edit_add_col')
                </div>
            </div>
        </div>
    </form>
@endsection
