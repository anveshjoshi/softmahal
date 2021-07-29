@extends('layouts.app')

@section('content')

<div id="formModal" class="modal fade" role="dialog" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="update_user" enctype="multipart/form-data">
                     <div class="form-group row">
                         <label for="image" class="col-md-4 col-form-label text-md-right">
                             {{ __('Profile Picture') }}
                         </label>

                         <div class="col-md-6">
                             <input id="image" type="file" class="@error('image') is-invalid @enderror" name="image">

                             @error('image')
                                 <span class="invalid-feedback" role="alert">
                                     <strong>{{ $message }}</strong>
                                 </span>
                             @enderror
                         </div>
                     </div>

                     <div class="form-group row">
                         <label for="name" class="col-md-4 col-form-label text-md-right">
                             {{ __('Name') }}
                         </label>

                         <div class="col-md-6">
                             <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

                             @error('name')
                                 <span class="invalid-feedback" role="alert">
                                     <strong>{{ $message }}</strong>
                                 </span>
                             @enderror
                         </div>
                     </div>

                     <div class="form-group row">
                         <label for="email" class="col-md-4 col-form-label text-md-right">
                             {{ __('E-Mail Address') }}
                         </label>

                         <div class="col-md-6">
                             <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email" autofocus>

                             @error('email')
                                 <span class="invalid-feedback" role="alert">
                                     <strong>{{ $message }}</strong>
                                 </span>
                             @enderror
                         </div>
                     </div>
                     <div class="text-center p-2">
                         <button id="update" class="btn btn-info">Update</button>
                     </div>
                 </form>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">{{ __('Your profile') }}</div>
                    <div class="card-body">
                        <div class="row p-2">
                            <div class="col-md-5">
                                <img src="{{ asset('storage/users/'.$user->image) }}" alt="{{ $user->name }}" height="200px">
                            </div>
                            <div class="col-md-7 text-center">
                                <h2>{{ $user->name }}</h2>
                                <h4>{{ $user->email }}</h4>
                                <a href="#" data-toggle="modal" data-target="#formModal">
                                    <button class="btn btn-info">Edit Profile</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).on('submit', '#update_user', function(e) {
        e.preventDefault();

        let formData = new FormData($('#update_user')[0]);
        formData.append('_method', 'PUT');

        let url = "/user/" + {{ $user->id }};
        $.ajax({
            type: 'POST',
            url: url,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: formData,
            contentType: false,
            processData: false,
            success: function() {
                $('#formModal').hide();
                location.reload();
            }
        });
        
    });
</script>
