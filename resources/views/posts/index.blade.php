@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Posts</div>

                <div class="table-responsive">
                    <form action="{{ route('posts.index') }}" method="get" class="m-3 form-inline">
                        <div class="form-group">
                            <label for="rg-from" class="pr-3">Filter: </label>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="checkbox" name="filter_approved[]" class="form-check-input" onchange="this.form.submit()" value="1" 
                                    @if(Request::get('filter_approved'))
                                        {{ in_array("1", Request::get('filter_approved')) ? "checked" : "" }}
                                    @endif
                                    >Approved
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="checkbox" name="filter_approved[]" class="form-check-input" onchange="this.form.submit()" value="0"
                                    @if(Request::get('filter_approved'))
                                        {{ in_array("0", Request::get('filter_approved')) ? "checked" : "" }}
                                    @endif
                                    >Waiting
                                </label>
                            </div>
                        </div>
                    </form>

                    @include('posts.includes.table')

                    <div class="pagination justify-content-center">
                        {{ $posts->appends(['filter_approved' => Request::get('filter_approved')])->links() }}
                    </div>

                    @can('create', Post::class)
                        @include('posts.includes.actions.add')
                    @endcan
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
