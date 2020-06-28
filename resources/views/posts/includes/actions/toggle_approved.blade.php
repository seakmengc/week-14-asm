<button class="btn btn-outline-{{ $post->is_approved ? 'danger' : 'success' }} container-fluid ajax-toggle-approved" data-url="{{ route('posts.ajax_toggle_approved', $post) }}" data-id="post-approved-{{ $post->id }}" id="post-approved-{{ $post->id }}">
	@if($post->is_approved)
		<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-dash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
			<path fill-rule="evenodd" d="M3.5 8a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.5-.5z"/>
		</svg>
		Disapprove
	@else
		<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
			<path fill-rule="evenodd" d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
		</svg> 
		Approve
	@endif
</button>
