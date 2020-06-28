<div class="content">
    @include('adminlte-templates::common.errors')

    {!! Form::open(['route' => 'comments.store']) !!}

        @include('comments.fields')

    {!! Form::close() !!}
</div>
