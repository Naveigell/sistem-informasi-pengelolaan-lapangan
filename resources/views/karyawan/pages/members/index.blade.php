<?php
/**
 * @var \App\Models\Member $members
 */
?>

@extends('layouts.karyawan.karyawan')

@section('content')
    <div style="margin: 20px; padding: 10px;">
        <h3><i class="fa fa-angle-right"></i> Tabel Data Member</h3>
        <div class="row mb">
            <div class="content-panel" style="padding: 20px 20px 60px 20px;">
                @if(session()->has('success'))
                    <br>
                    <br>
                    <x-alert :title="session()->get('success')"></x-alert>
                @endif
                <div class="adv-table">
                    <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
                        <thead>
                        <tr>
                            <th class="hidden-phone">No</th>
                            <th class="hidden-phone">Nama Member</th>
                            <th class="hidden-phone">Alamat member</th>
                            <th class="hidden-phone">No telepon</th>
                            <th class="hidden-phone">Status</th>
                            @if(auth('karyawan')->user()->jabatan === 'staff')
                                <th class="hidden-phone">Aksi</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($members as $member)
                            <tr class="gradeX">
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $member->nama_member }}</td>
                                <td>{{ $member->alamat_member }}</td>
                                <td>{{ $member->hp }}</td>
                                <td>{{ ucfirst($member->status) }}</td>
                                @if(auth('karyawan')->user()->jabatan === 'staff')
                                    <td>
                                        <a href="{{ route('karyawan.members.edit', $member) }}" class="btn btn-warning btn-sm">Edit</a>
                                        {{--                                    <a href="{{ route('karyawan.members.edit', $member) }}" class="btn btn-primary btn-sm">Lihat History</a>--}}
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- page end-->
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            var oTable = $('#hidden-table-info').dataTable();
        });
    </script>
@endsection
