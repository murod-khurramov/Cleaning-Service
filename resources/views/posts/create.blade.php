<x-layouts.main xmlns:x-slot="http://www.w3.org/1999/xlink">
    <x-slot:title>
        Create Post
    </x-slot:title>

    <x-page-header>
        New Post Create
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
                <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="control-group mb-3">
                        <input type="text" class="form-control p-4" name="title" value="{{ old('title') }}"
                               placeholder="Title"/>
                        @error('title')
                            <p class="help-block text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="control-group">
                        <input name="photo" type="file" class="form-control p-4" id="subject" placeholder="Photo"/>
                        @error('photo')
                            <p class="help-block text-danger">{{ $message }}</p>
                        @enderror                    </div>
                    <div class="control-group">
                        <textarea class="form-control p-4" rows="3" name="short_content"
                                  placeholder="Short Content">{{ old('short_content') }}</textarea>
                        @error('short_content')
                        <p class="help-block text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="control-group mt-3">
                        <textarea class="form-control p-4" rows="6" name="content"
                                  placeholder="Content">{{ old('content') }}</textarea>
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
