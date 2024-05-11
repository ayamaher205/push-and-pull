@extends('layouts.app')

@Section('content')
    <div class="containter d-flex mx-auto justify-content-around my-5">
        <a href="/posts/create" class="btn btn-info m-l-5 ">Add Post</a>
        <a href="/restoreAll" class="btn btn-success m-l-5 ">restore All Deleted Posts</a>
    </div>
    <table class="table align-middle mb-0 bg-white">
        <thead class="bg-light">
            <tr>
                <th class="text-center">image</th>
                <th class="text-center">Title</th>
                <th class="text-center">body</th>
                <th class="text-center">Creator</th>
                <th class="text-center">Tags</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr id="post-row-{{$post->id}}">
                    <td class="text-center">
                        <div class="d-flex align-items-center justify-content-center">
                            <img src="{{ asset('images/posts/' . $post->image) }}" alt=""
                                style="width: 45px; height: 45px" class="rounded-circle" />
                        </div>
                    </td>
                    <td class="text-center">
                        <p class="fw-bold mb-1">{{ $post->title }} </p>
                    </td>
                    <td class="text-center">
                        <p class="fw-normal mb-1">{{ $post->body }}</p>
                    </td>
                    <td class="text-center">
                        <p> {{ $post->creator ? $post->creator->name : 'no creator' }}</p>
                    </td>
                    <td class="text-center">
                        <p>
                            @if ($post->tags)
                                @foreach ($post->tags as $tag)
                                    <span>{{ $tag->name }}</span>
                                @endforeach
                            @else
                                no tags
                            @endif
                        </p>
                    </td>
                    <td class="text-center">
                    <form>
                        <button class="btn btn-danger delete-post" name="{{ $post->id }}" type="submit">Delete</button>
                    </form>

                        <a rel='tooltip' class='btn btn-success btn-just-icon btn-sm' data-original-title='' title=''
                            href="/posts/{{ $post->id }}/edit">
                            edit
                        </a>
                        <a rel='tooltip' class='btn btn-secondary btn-just-icon btn-sm' data-original-title=''
                            title='' href="/posts/{{ $post->id }}" {{-- {{route('posts.show',$user['id'])}} --}}>
                            Show
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- Modal --}}
{{--     @foreach ($posts as $post)
        <div class="modal fade modal-dialog" id="staticBackdrop{{ $post->id }}" data-bs-backdrop="static"
            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel{{ $post->id }}"
            aria-hidden="true"
            style="
            position: absolute;
            float: left;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Warning</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this Post?!
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" name=""
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger delete-post" name="{{ $post->id }}">Yes</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach --}}
    <div class="d-flex justify-content-center mt-5">
        {!! $posts->links() !!}
    </div>
    <script>
        var deleteButtons = document.querySelectorAll('.delete-post');
        deleteButtons.forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                var postId = button.getAttribute('name'); 
                var url = '/posts';
                var myxhr = new XMLHttpRequest();
                myxhr.open('DELETE', url + `/${postId}`, true);
                myxhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
    
                myxhr.onreadystatechange = function() {
                    if (myxhr.readyState === 4 && myxhr.status === 200) {
                        console.log('deleted')
                        var deletedRow = document.getElementById('post-row-' + postId);
                        if (deletedRow) {
                            deletedRow.remove(); 
                        }
                    } else {
                        console.log('Error deleting post');
                    }
                };
    
                myxhr.send();
            });
        });




        var deleteButtons = document.querySelectorAll('.delete-post');
        deleteButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var postId = button.getAttribute('name'); 
            var url = `http://127.0.0.1:8000/posts/${postId}`;
            $.ajax({

                method: "delete",

                url,
                success: function(res) {
                    console.log("request successed", res)
                     var deletedRow = document.getElementById('post-row-' + postId);
                        if (deletedRow) {
                            deletedRow.remove(); 
                        }
                },
                error: function() {
                    console.log("Error, can't delete row")
                }

            })
        })

        });
    </script>
    
@endsection
