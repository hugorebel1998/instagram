<div class="text-center avatar pb-4" >
    @if (Auth::user()->image)
        <img src="{{ route('user.avatar', ['filename' => Auth::user()->image]) }}"
            class="img-fluid mx-auto d-block" width="200">
    @endif
</div>