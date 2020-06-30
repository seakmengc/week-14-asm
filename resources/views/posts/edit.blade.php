@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit {{ $post->name }}</div>

                    <form action="{{ route('posts.update', $post) }}" class="p-3 pb-5" method="post">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="title">Title *</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') ?? $post->title }}" required>
                            <p class="text-danger">@error('title') {{ $errors->first('title') }} @enderror</p>
                        </div>

                        <div class="form-group">
                            <label for="content">Content *</label>
                            <input type="text" class="form-control @error('content') is-invalid @enderror" id="content" name="content" value="{{ old('content') ?? $post->content }}" required>
                        </div>
                        <p class="text-danger">@error('content') {{ $errors->first('content') }} @enderror</p>

                        <div class="form-group">
                            <select class="form-control" name="category_id">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $category->id == $post->category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <p class="text-danger">@error('category_id') {{ $errors->first('category_id') }} @enderror</p>
                        </div>


                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
