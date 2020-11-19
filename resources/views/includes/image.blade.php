<div class="card pu_image mt-5">
    <div class="card-header">
        @if ($image->user->image)
            <div class="container-avatar_mu">
                <img src="{{ route('user.avatar', ['filename' => $image->user->image]) }}"
                    class="img-fluid mx-auto d-block">
            </div>
        @endif
        <div class="mt-2">

            <p>
                <a href="{{ route('image.detail', ['id' => $image->id]) }} " class="detalle">
                    <b>{{ $image->user->name . ' ' . $image->user->surname }}</b> | @
                    {{ $image->user->nick }}

                </a>
            </p>

        </div>
    </div>

    <div class="card-body">
        <div class="justify-content-center image">
            <img src="{{ route('image.file', ['filename' => $image->image_path]) }}"
                class="img-fluid mx-auto d-block">
        </div>

        <div class="likes pl-4 pt-3">
            {{-- Comprobar si el usuario le dio like a la publicación--}}
            <?php $user_like = false; ?>
           @foreach ($image->likes as $like)
               @if ($like->user->id == Auth::user()->id)
               <?php $user_like = true; ?>
               @endif
          @endforeach

          @if ($user_like)
          {{-- <i class="fas fa-heart text-danger btn-dislike" id="like"></i> --}}
          <img src="{{ asset('img/heart-red.png')}}" data-id="{{ $image->id}}" class="img-liks btn-dislike">
          @else                                  
          {{-- <i class="fas fa-heart  btn-like text-primary" id="like"></i> --}}
          <img src="{{ asset('img/heart.png')}}" data-id="{{ $image->id}}" class="img-liks btn-like">
          @endif
        </div>
        <div class="count_likes mt-2">
         <span class="pl-4 likes">{{ count($image->likes) }} Me gusta</span>
        </div>
        <div class="desciption pl-4 mt-3 mb-4">
            <span>{{ '@' . $image->user->nick }}</span>
            <p class="">{{ $image->description }}</p>
        </div>
        <span class="pl-4 fecha">
            {{ \FormatTime::LongTimeFilter($image->created_at) }}
        </span>
        <hr>
        <a href="#" class="btn btn-sm btn-warning ml-4 mb-3">
            Comentarios ({{ count($image->comments) }})
        </a>
    </div>
</div>