@extends('layouts.backend')

@section('title','Rumah Sakit')

@section('css')
    <!-- datatables -->
    <link href="<?=base_url('assets/plugins/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">
@endsection

@section('content')
    <?php 
        $privileges = explode(',', $priv['privileges']);
    ?>
    <div class="page-title">
        <div class="title_left">
            <h3>Rumah Sakit</h3>
        </div>
        <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                    <button class="btn btn-default" type="button">Go!</button>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Rumah Sakit</h2>
                    <?php if($privileges[0] == 1): ?>
                        <div class="navbar-right">
                            <a href="<?=base_url('rumah_sakit/add')?>">
                                <button type="button" class="btn btn-sm btn-primary">
                                    <i class="fa fa-plus"></i> Add
                                </button>
                            </a>
                        </div>
                    <?php endif ?>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table class="table table-bordered table-striped" id="myTable">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th>Foto</th>
                                <th>Rumah Sakit</th>
                                <th>Alamat</th>
                                <th>Kontak Rumah Sakit</th>
                                <th>Jadwal</th>
                                <?php if($privileges[1] == 1 || $privileges[2] == 1): ?>
                                <th width="5%">Action</th>
                                <?php endif ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; foreach($rumah_sakit as $key => $value):?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td> 
                                    <?php if($value['foto'] == '-'): ?>
                                        <ul>
                                            <li><img class="img img-rounded" src="<?=base_url('assets/images/no-image.png')?>" style="width: 40px;height: 40px;"></li>
                                        </ul>
                                    <?php else: ?>
                                        <ul>
                                            <?php foreach($value['foto'] as $k => $v): ?>
                                                <li><img src="<?=base_url('assets/images/rumah_sakit/')?>"></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endif ?>
                                </td>
                                <td><?= $value['nama_rumah_sakit'] ?></td>
                                <td><?= $value['alamat'] ?></td>
                                <td>
                                    <ul>
                                        <li>No. Telp : <?= $value['no_telp'] ?></li>
                                        <li>No. Fax : <?= $value['no_fax'] ?></li>
                                        <li>Email : <?= $value['email'] ?></li>
                                    </ul>
                                </td>
                                <td>
                                    <?php if($value['jadwal'] == '-'): ?>
                                        <ul>
                                            <li>Belum ada jadwal</li>
                                        </ul>
                                    <?php else: ?>
                                        <ul>
                                            <?php foreach($value['jadwal'] as $k => $v): ?>
                                                <li><?= $v['jam'] ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endif ?>
                                </td>
                                <?php if($privileges[1] == 1 || $privileges[2] == 1): ?>
                                    <td>
                                        <ul style="list-style: none;padding-left: 0px;padding-right: 0px; text-align: center;">
                                            <li class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-bars" style="font-size: large;"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-right" style="right: 0; left: auto;">
                                                    <?php if($privileges[1] == 1): ?>
                                                        <li>
                                                            <a href="<?=base_url('rumah_sakit/update/'.encode($value['id']))?>">
                                                                <i class="fa fa-pencil"></i> Edit
                                                            </a>
                                                        </li>
                                                    <?php endif ?>
                                                    <?php if($privileges[1] == 1 && $privileges[2] == 1): ?>
                                                        <li class="divider"></li>
                                                    <?php endif ?>
                                                    <?php if($privileges[2] == 1): ?>
                                                        <li>
                                                            <a href="#" class="btn-delete" data-id="<?=encode($value['id'])?>">
                                                                <i class="fa fa-trash"></i> Delete
                                                            </a>
                                                        </li>
                                                    <?php endif ?>
                                                </ul>
                                            </li>
                                        </ul>
                                    </td>
                                <?php endif ?>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- datatables -->
    <script src="<?=base_url('assets/plugins/datatables/js/jquery.dataTables.js')?>"></script>
    <script src="<?=base_url('assets/plugins/datatables/js/dataTables.bootstrap.js')?>"></script>
    <!-- delete js -->
    <script src="<?=base_url('assets/js/delete.js')?>"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                "order": [[ 1, "asc" ]],
                "scrollX": true
            });
        });
    </script>
@endsection