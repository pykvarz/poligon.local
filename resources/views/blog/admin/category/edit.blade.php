@extends('layouts.base');

@section('content')
    @php
        /** @var \App\Models\BlogCategory $item */
    @endphp

    @if($item->exists)
        <form action="{{ route('blog.admin.categories.update', $item->id) }}" method="POST">
        @csrf
        @method('PATCH')
    @else
        <form action="{{route('blog.admin.categories.store')}}" method="post">
        @csrf
    @endif
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

            @if(session('success'))
                <div class="row justify-content-center">
                    <div class="col-md-11">
                        <div class="alert alert-success" role="alert">
                            <button class="close" type="button" data-dismis="alert" aria-label="Close">
                                <span aria-hidden="true"></span>
                            </button>
                            {{ session()->get('success') }}
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
