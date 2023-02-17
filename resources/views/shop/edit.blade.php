@extends('base')
@section('modalContent')
@error('message')
            <div style="width:100%; " class="mt-100">
               <span class="alert alert-danger" style="width:300px; display:block; margin:0 auto; text-align:center">{{ $message }}</span>
            </div>
        @enderror
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8" style="width:80%;">
            <div class="card mt-50 mb-50" style="border:0;">
                <div class="card-body">
                    <form method="POST" action="{{ url('shop/' . $shop->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row mb-3" style="margin-top:20px;">
                            <label for="name" class="col-md-4 col-form-label text-md-end" style="font-size:20px;">{{ __('Name') }}</label>
                            
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $shop->name) }}" required>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3" style="margin-top:20px;">
                            <label for="price" class="col-md-4 col-form-label text-md-end" style="font-size:20px;">{{ __('Price') }}</label>
                            
                            <div class="col-md-6">
                                <input id="price" type="number" step="0.01" class="form-control" name="price" value="{{ old('price', $shop->price) }}" placeholder="99.99" required>

                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3" style="margin-top:20px;">
                            <label for="type" class="col-md-4 col-form-label text-md-end" style="font-size:20px;">{{ __('Category') }}</label>
                                
                            <div class="col-md-6">
                                <select name="type" id="type" required>
                                        <option value="men" <?php if($shop->category == 'men') echo 'selected' ?>>Men</option>
                                        <option value="women"<?php if($shop->category == 'women') echo 'selected' ?>>Women</option>
                                        <option value="child"<?php if($shop->category == 'child') echo 'selected' ?>>Child</option>
                                </select>
                                @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3" style="margin-top:20px;">
                            <label for="description" class="col-md-4 col-form-label text-md-end" style="font-size:20px;">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <textarea id="description" rows="20" class="form-control" name="description" requiered style="width:500px;">{{ old('description', $shop->description) }}</textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3" style="margin-top:20px;">
                            <label for="thumbnail" class="col-md-4 col-form-label text-md-end" style="font-size:20px;">{{ __('Thumbnail') }}</label>
                            <div class="col-md-6">
                                <input type="file" name="thumbnail" id="thumbnail" accept="image/jpeg" />
                                <div style=" width:140px; height:140px; background-image: url('data:image/jpeg;base64,{{ $shop->thumbnail }}'); background-size:cover; margin:20px auto;"></div>
                            </div>
                        </div>
                        
                        <div class="row mb-0" style="margin-top:30px;">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn" style="background-color:black; color:white; width:80px;">
                                    {{ __('EDIT') }}
                                </button>
                                <a class="btn" href="{{ url('/') }}" style="background-color:black; color:white; width:80px;">BACK</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection