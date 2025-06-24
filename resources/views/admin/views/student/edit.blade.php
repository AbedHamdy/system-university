@extends("admin.layouts.app")
@section("title", "ُEdit Student Fees")
@section("content")
    <form action="{{ route('update_student', $student->id) }}" method="POST">
        @csrf
        @method('PUT')
        <!-- باقي الحقول ... -->

        <div class="mb-3">
            <label for="discount" class="form-label">Discount</label>
            <input
                type="number"
                step="0.01"
                name="discount"
                id="discount"
                class="form-control"
                value="{{ old('discount', $student->discount) }}"
                required
            >
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-orange px-4">Update Student</button>
        </div>
    </form>
@endsection
