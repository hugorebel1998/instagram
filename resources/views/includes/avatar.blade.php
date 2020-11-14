<div class="text-center container-avatar" >
    @if (Auth::user()->image)
        <img src="{{ route('user.avatar', ['filename' => Auth::user()->image]) }}"
            class="mb-3" width="200">
    @endif
</div>