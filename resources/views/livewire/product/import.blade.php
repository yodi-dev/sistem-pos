<div>
    <div class="card card-compact bg-base-100 w-96 shadow-xl mb-5">
        <div class="card-body text-base-content">
            <form action="{{ route('import.products') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="flex space-x-2">
                    <label class="form-control w-full max-w-xs">
                        <input type="file" name="file" id="file" required
                            class="file-input  file-input-sm file-input-bordered w-full max-w-xs rounded-md" />
                    </label>
                    <button class="btn btn-sm btn-neutral rounded-md text-base-100" type="submit">Kirim</button>
                </div>
            </form>
        </div>
    </div>

</div>