@if ($errors->any())
    <div class="mb-6 bg-red-50 text-red-700 p-4 rounded-lg">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
