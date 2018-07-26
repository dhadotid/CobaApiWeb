@extends('base')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
            </div>
            <!-- Basic Table -->
		@if(Session::has('alert-success'))
                <div class="alert alert-success">
                    <strong>{{ \Illuminate\Support\Facades\Session::get('alert-success') }}</strong>
                </div>
            @endif
            @if(Session::has('alert-danger'))
                        <div class="alert alert-danger">
                            <strong>{{ \Illuminate\Support\Facades\Session::get('alert-danger') }}</strong>
                        </div>
                    @endif

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Admin
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="{{route('account.create')}}" methods="post">
                                        <i class="material-icons">account_box</i>
                                        <span>Tambah Admin</span>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="body table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>NIM</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Roles</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $no = 1 @endphp
                                @foreach($admin as $a)
                                    <tr>
                                        <th scope="row">{{ $no++ }}</th>
                                        <td>{{$a->NIM}}</td>
                                        <td>{{$a->name}}</td>
                                        <td>{{$a->email}}</td>
                                        <td> @php if($a->roles == 1)
                                            {
                                                echo "Aktivis";
                                            }else if ($a->roles == 2)
                                            {
                                                echo "Manager";
                                            }elseif ($a -> roles == 3)
                                            {
                                              echo "Surveyor";
                                            }elseif($a -> roles == 4)
                                            {
                                              echo "Wakil Dekan";
                                            }
                                            @endphp</td>
                                        <td>@php if($a->status == 0)
                                            {
                                                echo "Belum Terverifikasi";
                                            } else if ($a->status == 1)
                                            {
                                                echo  "Sudah Verif";
                                            }
                                            @endphp</td>
                                        <td>

                                            <form action="{{ route('account.destroy', $a->NIM) }}" method="post">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <a href="{{ route('account.edit',$a->NIM) }}" name="edit" value="edit" class=" btn btn-sm btn-primary">Update</a>
                                                @php if($a->status == 0)
                                              {
                                                @endphp
                                                <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Yakin ingin mengarsip data?')">Arsip</button>
                                                @php
                                              } else if($a->status == 1)
                                                    {
                                                @endphp
                                                <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Yakin ingin mengarsip data?')">Aktif</button>
                                                @php
                                                    }
                                                @endphp

                                            </form>

                                        </td>
                                    </tr>
                                </tbody>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
