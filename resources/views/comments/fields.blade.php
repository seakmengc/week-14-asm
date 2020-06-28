<input name="post_id" hidden value="{{ $post->id }}" />

<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::text('name', null, ['class' => 'form-control input-sm', 'placeholder'=> 'Name']) !!}
</div>

<!-- Comment Field -->
<div class="form-group col-sm-12">  
    {!! Form::text('comment', null, ['class' => 'form-control', 'placeholder'=> 'Comment']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Post', ['class' => 'btn btn-primary']) !!}
</div>
