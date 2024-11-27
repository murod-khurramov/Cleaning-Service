<x-layouts.main xmlns:x-slot="http://www.w3.org/1999/xlink">
    <x-slot:title>
        Change Posts #{{$post->id}}
    </x-slot:title>

    <x-page-header>
        Change Posts #{{$post->id}}
    </x-page-header>

    <div class="container">
        <div class="w-50 py-4">
            <div class="contact-form">
                <div id="success"></div>
                {{--                @if ($errors->any())--}}
                {{--                    <div class="alert alert-danger">--}}
                {{--                        <ul>--}}
                {{--                            @foreach ($errors->all() as $error)--}}
                {{--                                <li>{{ $error }}</li>--}}
                {{--                            @endforeach--}}
                {{--                        </ul>--}}
                {{--                    </div>--}}
                {{--                @endif--}}
                <form action="{{ route('posts.update', ['post' => $post->id]) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="control-group mb-3">
                        <input type="text" class="form-control p-4" name="title" value="{{ $post->title }}"
                               placeholder="Title"/>
                        @error('title')
                        <p class="help-block text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="control-group mb-3">
                        <input name="photo" type="file" class="form-control p-4" placeholder="Photo" id="subject"/>
                        @error('photo')
                        <p class="help-block text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="control-group">
                        <textarea class="form-control p-4" rows="3" name="short_content"
                                  placeholder="Short Content">{{ $post -> short_content }}</textarea>
                        @error('short_content')
                        <p class="help-block text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="control-group mt-3">
                        <textarea class="form-control p-4" rows="6" name="content"
                                  placeholder="Content">{{ $post -> content }}</textarea>
                        @error('content')
                        <p class="help-block text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <button class="btn btn-primary btn-block py-3 px-5 mt-3" type="submit">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-layouts.main>
<?php
