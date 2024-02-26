@extends('layouts.app')
@section('title','Profile')
@section('content')

                <div class="card">
                  <form method="post" action="{{route('profile.update')}}" class="needs-validation" novalidate="">
                    @csrf
                    <div class="card-header h3 ">Edit Profile</div>
                    <div class="card-body">
                        <div class="row">
                          <div class="form-group col-md-6 col-12">
                            <label>Name</label>
                            <input type="text" name='name' value="{{auth()->user()->name}}" class="form-control"  required="">
                            <div class="invalid-feedback">
                              Please fill in the Name
                            </div>
                          </div>
                          <div class="form-group col-md-6 col-12">
                            <label>Username</label>
                            <input type="text" readonly class="form-control" value="{{auth()->user()->username}}" required="">
                            <div class="invalid-feedback">
                              Please fill in the last name
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-md-6 col-12">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" value="{{auth()->user()->email}}" required="">
                            <div class="invalid-feedback">
                              Please fill in the email
                            </div>
                          </div>


                        </div>
                        @if (auth()->user()->role=="siswa")
                            {{-- expr --}}

                        <div class="row mt-2">
                    <div class="form-group col-6">
                    <label for="nama_orangtua">Nama Orang Tua</label>
                    <input id="nama_orangtua" value="{{auth()->user()->nama_orangtua}}" required type="text" class="form-control  @error('nama_orangtua') is-invalid @enderror" name="nama_orangtua">
                     @error('nama_orangtua')
                      <div class="invalid-feedback">{{$message}}</div>
                      @enderror
                  </div>
                    <div class="form-group col-6">
                      <label for="nohp_orangtua" class="d-block">No HP Orang Tua</label>
                      <input id="nohp_orangtua" value="{{auth()->user()->nohp_orangtua}}" required type="text" class="form-control pwstrength" data-indicator="pwindicator" name="nohp_orangtua">
                       @error('nohp_orangtua')
                      <div class="invalid-feedback text-danger">{{$message}}</div>
                      @enderror
                    </div>

                  </div>
                        <div class="row">
                       <div class="form-group col-6">
                      <label for="alamat" class="d-block">Alamat</label>
                      <input id="alamat" required type="text" class="form-control pwstrength" data-indicator="pwindicator" name="alamat">
                       @error('alamat')
                      <div class="invalid-feedback text-danger">{{$message}}</div>
                      @enderror
                    </div>
                    <div class="form-group col-6">
                      <label>Pendidikan</label>
                      <select class="form-control selectric" name="tkt_pendidikan">
                                    <option {{(auth()->user()->nama_orangtua=="TK")?"selected":""}} value="TK">TK</option>
                                    <option {{(auth()->user()->nama_orangtua=="SD1")?"selected":""}} value="SD1">SD 1</option>
                                    <option {{(auth()->user()->nama_orangtua=="SD2")?"selected":""}} value="SD2">SD 2</option>
                                    <option {{(auth()->user()->nama_orangtua=="SD3")?"selected":""}} value="SD3">SD 3</option>
                                    <option {{(auth()->user()->nama_orangtua=="SD4")?"selected":""}} value="SD4">SD 4</option>
                                    <option {{(auth()->user()->nama_orangtua=="SD5")?"selected":""}} value="SD5">SD 5</option>
                                    <option {{(auth()->user()->nama_orangtua=="SD6")?"selected":""}} value="SD6">SD 6</option>
                                    <option {{(auth()->user()->nama_orangtua=="SMP1")?"selected":""}} value="SMP1">SMP 1</option>
                                    <option {{(auth()->user()->nama_orangtua=="SMP2")?"selected":""}} value="SMP2">SMP 2</option>
                                    <option {{(auth()->user()->nama_orangtua=="SMP3")?"selected":""}} value="SMP3">SMP 3</option>
                                    <option {{(auth()->user()->nama_orangtua=="SMA/SMK1")?"selected":""}} value="SMA/SMK1">SMA/SMK 1</option>
                                    <option {{(auth()->user()->nama_orangtua=="SMA/SMK2")?"selected":""}} value="SMA/SMK2">SMA/SMK 2</option>
                                    <option {{(auth()->user()->nama_orangtua=="SMA/SMK3")?"selected":""}} value="SMA/SMK3">SMA/SMK 3</option>
                                    <option {{(auth()->user()->nama_orangtua=="Mahasiswa")?"selected":""}} value="Mahasiswa">Mahasiswa</option>
                                    <option {{(auth()->user()->nama_orangtua=="Umum")?"selected":""}} value="Umum">Umum</option>
                                </select>
                    </div>


                  </div>
                   @endif


                    </div>
                    <div class="card-footer text-right">
                      <button class="btn btn-primary">Save Changes</button>
                    </div>
                  </form>
                </div>

    <div class="card">
        <div class="card-header h4">
            Change Password
        </div>
        <div class="card-body">
            <form action="{{route('reset.password.post')}}" method="POST">
                @csrf
                <div class="row form-group">
                    <div class="col-sm-6">
                         <input type="hidden" name="key" value="{{base64_encode(auth()->id())}}">
                        <label>Password</label>
                        <input type="text" name="password" class="form-control">
                    </div>
                     <div class="col-sm-6">
                        <label>Confirm Password</label>
                        <input type="text" name="password_confirmation" class="form-control">
                    </div>
                </div>
                <button class="btn btn-primary float-right" type="submit">Save</button>
            </form>
        </div>
    </div>

@endsection

