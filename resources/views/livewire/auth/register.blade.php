<div class="row justify-content-center mt-5">
    <div class="col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h4 class="text-center mb-4">Create an Account</h4>

                <form wire:submit.prevent="register">
                    <div class="mb-3">
                        <label>Full Name</label>
                        <input type="text" wire:model.defer="name" class="form-control @error('name') is-invalid @enderror">
                        @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label>Email Address</label>
                        <input type="email" wire:model.defer="email" class="form-control @error('email') is-invalid @enderror">
                        @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" wire:model.defer="password" class="form-control @error('password') is-invalid @enderror">
                        @error('password') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label>Confirm Password</label>
                        <input type="password" wire:model.defer="password_confirmation" class="form-control">
                    </div>

                    <div class="d-grid">
                        <button class="btn btn-success">Register</button>
                    </div>
                </form>

                <div class="text-center mt-3">
                    <small>Already have an account? <a href="{{ route('login') }}">Login</a></small>
                </div>
            </div>
        </div>
    </div>
</div>
