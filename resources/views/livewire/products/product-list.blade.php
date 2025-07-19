<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Product List</h3>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-danger">
                <i class="bi bi-box-arrow-right"></i> Logout
            </button>
        </form>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form wire:submit.prevent="save" enctype="multipart/form-data" class="mb-4">

        <div class="row g-3">
            <div class="col-md-4">
                <label>Product Code</label>
                <input type="text" wire:model="code" class="form-control @error('code') is-invalid @enderror">
                @error('code') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-4">
                <label>Name</label>
                <input type="text" wire:model="name" class="form-control @error('name') is-invalid @enderror">
                @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-4">
                <label>Quantity</label>
                <input type="number" wire:model="quantity" class="form-control @error('quantity') is-invalid @enderror">
                @error('quantity') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-4">
                <label>Price</label>
                <input type="number" step="0.01" wire:model="price" class="form-control @error('price') is-invalid @enderror">
                @error('price') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-4">
                <label>Description</label>
                <textarea wire:model="description" class="form-control @error('description') is-invalid @enderror"></textarea>
                @error('description') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-4">
                <label>Image</label>
                <input type="file" wire:model="image" class="form-control @error('image') is-invalid @enderror">
                @error('image') <div class="text-danger small">{{ $message }}</div> @enderror

                @if ($isEdit)
                    @if ($image)
                        <img src="{{ $image->temporaryUrl() }}" class="img-thumbnail mt-2" width="100">
                    @else
                        <img src="{{ asset('storage/' . \App\Models\Product::find($productId)?->image) }}" class="img-thumbnail mt-2" width="100">
                    @endif
                @else
                    @if ($image)
                        <img src="{{ $image->temporaryUrl() }}" class="img-thumbnail mt-2" width="100">
                    @endif
                @endif
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-save"></i> {{ $isEdit ? 'Update' : 'Add' }} Product
                </button>

                @if($isEdit)
                    <button type="button" wire:click="resetForm" class="btn btn-secondary">Cancel</button>
                @endif
            </div>
        </div>
    </form>

    <table class="table table-bordered table-hover mt-4">
        <thead class="table-dark">
            <tr>
                <th>Image</th>
                <th>Code</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Description</th>
                <th width="150">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
                <tr>
                    <td>
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" width="60">
                        @else
                            <span class="text-muted">No Image</span>
                        @endif
                    </td>
                    <td>{{ $product->code }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>₱{{ number_format($product->price, 2) }}</td>
                    <td>{{ $product->description }}</td>
                    <td>
                        <button wire:click="edit({{ $product->id }})" class="btn btn-sm btn-primary">
                            <i class="bi bi-pencil"></i>
                        </button>

                        <button wire:click="delete({{ $product->id }})" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">No products found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div