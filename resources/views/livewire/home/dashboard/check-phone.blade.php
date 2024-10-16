<div>
    @if (Auth::user()->phone == null)
        <div class="w-full bg-red-300 text-red-700 py-2 px-4 text-sm rounded-lg text-center mb-4">
            <p>Please update your phone number to continue</p>
        </div>
    @endif
</div>
