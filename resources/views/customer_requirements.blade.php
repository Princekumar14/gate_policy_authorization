@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Requirements</h3>
    <hr>
    <div class="row justify-content-center">
        <div class="col-md-8">

            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    {{-- <th scope="col">Message</th> --}}
                    <th scope="col">Image</th>
                    <th scope="col">Page info</th>
                    <th scope="col">Status</th>
                    <th scope="col">Date</th>
                    <th>View</th>
                  </tr>
                </thead>
                <tbody>

                    @forelse ($requirements as $requirement)
                     <tr>
                        <th scope="row">{{ $requirement->id }}</th>
                        <td>{{ $requirement->customer_name }}</td>
                        <td>{{ $requirement->customer_email }}</td>
                        <td>{{ $requirement->customer_phone }}</td>
                        {{-- <td>{{ $requirement->customer_message }}</td> --}}
                        <td><img src="{{ asset('storage/uploads/'.$requirement->requested_product_image) }}" alt="" style="height: 50px;width:50px;"/></td>
                        <td>{{ $requirement->page_info }}</td>
                        <td>
                          @if ($requirement->status == 0)
                            <span class="badge badge-danger rounded-pill d-inline text-bg-danger">Pending</span>
                          @else
                            <span class="badge badge-success rounded-pill d-inline text-bg-success">Viewed</span>
                          @endif</td>
                        <td>{{ $requirement->requested_date }}</td>
                        <td>
                            <a href="{{ route('view.request', $requirement->id) }}" class="btn btn-sm btn-success">View</a>
                        </td>
                      </tr>
                      @empty
                        <h3>No requests yet</h3>
                    @endforelse

                </tbody>
              </table>

        </div>
    </div>
</div>
@endsection