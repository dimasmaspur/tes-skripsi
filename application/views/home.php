

  
        <!-- End of Sidebar -->

   

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Silahkan Pilih Menu</h1>
                    </div>


                    <?php 
                        foreach($datamenu as $data => $menu){
                    ?>

                    <!-- Content Row -->
                    <div class="row container">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="<?= base_url('uploads/'.$menu['image']);?>" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title"><?= $menu['nama'];?></h5>
                            <p class="card-text"><?= $menu['kategori'];?></p>
                            <p class="card-text">Rp. <?= $menu['harga'];?></p>
                            <a href="<?= base_url('android/create_cart/'.$menu['id'])?>" class="btn btn-warning">Tambah ke Keranjang</a>
                        </div>
                        </div>
                    </div> 
                    <br>
                <?php 
                }   
                ?>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

       