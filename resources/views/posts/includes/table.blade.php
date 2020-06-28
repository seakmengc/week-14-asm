<table class="table">
	<thead>
		<th>#</th>
		<th>Name</th>
		<th>Category</th>
		<th>Author</th>
		@auth
			<th class="text-center">Posting</th>
			<th class="text-center">Actions</th>
		@endauth
	</thead>

	<tbody>
	@forelse ($posts as $ind => $post)
		<tr id="post-{{ $post->id }}">
			<td>{{ $ind + 1 }}</td>
			<td>{{ $post->title }}</td>
			<td><a href="{{ route('categories.show', $post->category) }}">{{ $post->category->name }}</a></td>
			<td>{{ $post->author->name }}</td>
			@can('approve', $post)
				<td>@include('posts.includes.actions.toggle_approved')</td>
			@endcan

			<td>
				@can('view', $post)
					@include('posts.includes.actions.show')
				@endcan

				@can('update', $post)
					@include('posts.includes.actions.edit')
				@endcan

				@can('delete', $post)
					@include('posts.includes.actions.delete')
					@include('posts.includes.actions.ajax_delete')
				@endcan
			</td>
		</tr>
	@empty
		<tr>
			<td style="text-align: center" colspan="3">No post found.</td>
		</tr>
	@endforelse
	</tbody>
</table>