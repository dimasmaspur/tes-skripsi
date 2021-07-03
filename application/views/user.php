<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Data User</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
    
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Alamat</th>
                        <th>No Telp</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                <?php 
                    $no = 1;
                    foreach($datauser as $data => $user){
                ?>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $user['nama'];?></td>
                        <td><?= $user['username'];?></td>
                        <td><?= $user['alamat'];?></td>
                        <td><?= $user['no_telp'];?></td>
                        <td>
                        <a href="<?= base_url('dashboard/delete_user/'.$user['id'])?>" class="btn btn-danger btn-circle">
                            <i class="fas fa-trash"></i>
                        </a>
                        </td>
                    </tr>
                <?php
                    
                $no++;
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>