@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Requirement by - {{ $requirement->customer_name }}</h3>
        <hr>
        {{-- <div><a href="{{ route('customer.requirements') }}">All Requirements</a></div> --}}
        <button class="btn btn-warning btn-block mb-4"><a class="text-white text-decoration-none" href="{{ route('customer.requirements') }}">All Requirements</a></button>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <img class="card-img-top" alt="Product image" src="{{ asset('storage/uploads/' . $requirement->requested_product_image) }}" style="height:300px;object-fit: contain;object-position: center;" />
                    <div class="card-body">
                        <h5 class="card-title"><b>Phone :</b> {{ $requirement->customer_phone }}</h5>
                        <p class="card-text"><b>Page URL : </b>
                            {{ $requirement->page_info }}
                        </p>
                        <p class="card-text"><b>Message :</b>
                            @if ($requirement->customer_message != "")
                                {{ $requirement->customer_message }}
                            @else
                                {{ ' No Desription' }} 
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <h5 class="card-title ps-4 pt-4"><b>Add comment</b></h5>
                    <div class="card-body">
                        <form method="POST" action="{{ route('add.comment', $requirement->id) }}">
                            @csrf
                            @method('PUT')
                            <div data-mdb-input-init class="form-outline mb-4">
                                <textarea class="form-control" placeholder="No comments" id="satffComment" name="staff_comment" rows="4">@if ($requirement->staff_comment != ""){{ $requirement->staff_comment }}@endif</textarea>
                            </div>
                            <button class="btn btn-primary btn-block mb-4">Save Comment</button>
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
