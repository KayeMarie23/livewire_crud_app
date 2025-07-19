<div class="row justify-content-center mt-5">
    <div class="col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h4 class="card-title mb-4 text-center">Login</h4>

                @if (session()->has('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form wire:submit.prevent="login">

                    <div class="mb-3">
                        <label>Email</label>
                        <input wire:model.defer="email" type="email" class="form-control @error('email') is-invalid @enderror">
                        @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label>Password</label>
                        <input wire:model.defer="password" type="password" class="form-control @error('password') is-invalid @enderror">
                        @error('password') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-box-arrow-in-right"></i> Login
                        </button>
                    </div>
                </form>

                <div class="text-center mt-3">
                    <small>Don't have an account? <a href="{{ route('register') }}">Register</a></small>
                </div>
            </div>
        </div>
    </div>
</div>
