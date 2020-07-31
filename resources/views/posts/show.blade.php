@extends('layouts.app')

@section('title',$post->title)

@section('content')
<div class="container">
    <h1>{{$post->title}} </h1>
    <div class="text-secondary">
       <a href="/categories/{{$post->category->slug}}">{{$post->category->name}}</a>
       &middot; {{$post->created_at->format("d F, Y")}}
       &middot;
       @foreach ($post->tags as $tag)
    <a href="/tags/{{$tag->slug}}">{{$tag->name}}</a>
       @endforeach
    </div>
    <HR>
    <p>{{$post->body}}</p>
    <div>
        <div class="text-secondary">
           Wrote by {{$post->author->name}}
        </div>

       @can('delete', $post)

    <!-- Button trigger modal -->
<button type="button" class="btn btn-link text-danger btn-sm p-0" data-toggle="modal" data-target="#exampleModal">
    Delete
  </button>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Anda yakin ingin menghapus?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div>
                {{$post->title}}
            </div>
            <div>
                Published: {{$post->created_at->format("d F, Y")}}
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <form action="/posts/{{$post->slug}}/delete" method="post">
            @csrf
            @method("delete")
            <button class="btn btn-danger" type="submit">Delete</button>
        </form>
        </div>
      </div>
    </div>
  </div>
  @endcan
    </div>
</div>

@endsection
