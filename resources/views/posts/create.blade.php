@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Add new category</div>

                    <form action="{{ route('posts.store') }}" class="p-3 pb-5" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="title">Name *</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
                        </div>
                        <p class="text-danger">@error('title') {{ $errors->first('title') }} @enderror</p>

                        <div class="form-group">
                            <label for="content">Content *</label>
                            <input type="text" class="form-control @error('content') is-invalid @enderror" id="content" name="content" value="{{ old('content') }}" required>
                        </div>
                        <p class="text-danger">@error('content') {{ $errors->first('content') }} @enderror</p>

                        <div class="form-group">
                            <select class="form-control" name="category_id">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
