@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Requirement by - {{ $requirement->customer_name }}</h3>
        <hr>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <img src="{{ asset('storage/uploads/' . $requirement->requested_product_image) }}" style="height:300px"
                        class="card-img-top" alt="Hollywood Sign on The Hill" />
                    <div class="card-body">
                        <h5 class="card-title"><b>Phone :</b> {{ $requirement->customer_phone }}</h5>
                        <p class="card-text"><b>Description :</b><br>
                            {{ $requirement->customer_message }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <h5 class="card-title ps-4 pt-4"><b>Add comment</b></h5>
                    <div class="card-body">
                        <form method="POST" action="{{ route('add.comment') }}">
                            @csrf
                            @method('PUT')
                            <input type="text" name="request_id" value="{{ $requirement->id }}" hidden>
                            <div data-mdb-input-init class="form-outline mb-4">
                                <textarea class="form-control" id="satffComment" name="staff_comment" rows="4"></textarea>
                            </div>
                            <button class="btn btn-primary btn-block mb-4">Add Comment</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    {{-- <script>
        var form =  document.querySelector('form');
        form.addEventListener('submit', (event) => {
            var formData = new FormData(form);
            event.preventDefault();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                url: "{{ route('add.comment') }}",
                type: 'PUT',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    </script> --}}
@endsection
