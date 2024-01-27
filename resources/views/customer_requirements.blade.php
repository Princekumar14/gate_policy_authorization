@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Requirements</h3>
    <hr>
    <div class="row justify-content-center">
        <div class="col-md-10">

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
                        <td>
                          @if ($requirement->customer_name != "")
                            {{ $requirement->customer_name }}
                                
                          @else
                            {{ 'Customer' }} 
                          @endif
                        </td>
                        <td>
                          @if ($requirement->customer_email != "")
                          {{ $requirement->customer_email }}
                                
                          @else
                            {{ 'No Email' }} 
                          @endif
                        </td>
                        <td>{{ $requirement->customer_phone }}</td>
                        {{-- <td>
                          @if ($requirement->customer_message != "")
                                {{ Str::limit($requirement->customer_message, 15, '...'); }}
                                
                            @else
                                {{ ' No Message' }} 
                            @endif
                        </td> --}}
                        <td>
                          @if ($requirement->requested_product_image != "")
                          <img src="{{ asset('storage/uploads/'.$requirement->requested_product_image) }}" alt="Product image" style="height: 50px;object-fit: contain;object-position: center;"/></td>
                                
                          @else
                            {{ 'Product image' }} 
                          @endif
                        <td>
                          @if (Str::contains($requirement->page_info, 'product'))
                              {{ 'Product Page' }}
                          @else
                            {{ 'Direct Form' }}    
                          @endif
                        </td>
                        <td>
                          @if ($requirement->status == 0)
                            <span class="badge badge-danger rounded-pill d-inline text-bg-danger">Pending</span>
                          @else
                            <span class="badge badge-success rounded-pill d-inline text-bg-success">Viewed</span>
                          @endif</td>
                        <td>{{ $requirement->requested_date->format('d M, Y \a\t h:iA') }}</td>
                        <td>
                            <a href="{{ route('view.request', $requirement->id) }}" class="btn btn-sm btn-primary">View</a>
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
<style>
  td, th{
    text-align: center !important;
    vertical-align: middle !important;
  }
</style>
@endsection