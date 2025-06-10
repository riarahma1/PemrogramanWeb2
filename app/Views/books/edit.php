<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-8">
            <h2 class="my-3">Form Ubah Data Buku</h2>
            <form action="/books/update/<?= $books['id']; ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <input type="hidden" name="slug" value="<?= $books['slug']; ?>">
                <input type="hidden" name="sampulLama" value="<?= $books['sampul']; ?>">
                <div class="form-group row">
                    <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= (isset($validation) && $validation->hasError('judul')) ? 'is-invalid' : '';?>" id="judul" name="judul" value="<?= (old('judul')) ? old('judul') : $books['judul'] ?>" autofocus>
                        <?php if (isset($validation) && $validation->hasError('judul')): ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('judul'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <label for="penulis" class="col-sm-2 col-form-label">Penulis</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= (isset($validation) && $validation->hasError('penulis')) ? 'is-invalid' : '';?>" id="penulis" name="penulis" value="<?= (old('penulis')) ? old('penulis') : $books['penulis'] ?>">
                        <?php if (isset($validation) && $validation->hasError('penulis')): ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('penulis'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <label for="penerbit" class="col-sm-2 col-form-label">Penerbit</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= (isset($validation) && $validation->hasError('penerbit')) ? 'is-invalid' : '';?>" id="penerbit" name="penerbit" value="<?= (old('penerbit')) ? old('penerbit') : $books['penerbit'] ?>">
                        <?php if (isset($validation) && $validation->hasError('penerbit')): ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('penerbit'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <label for="sampul" class="col-sm-2 col-form-label">Sampul</label>
                    <div class="col-sm-2">
                        <img src="/img/<?= $books['sampul']; ?>" class="img-thumbnail img-preview" alt="Preview Gambar">
                    </div>
                    <div class="col-sm-8">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input <?= (isset($validation) && $validation->hasError('sampul')) ? 'is-invalid' : '';?>" id="sampul" name="sampul" onchange="previewImg()">
                            <label class="custom-file-label" for="sampul">Upload</label>
                            <?php if (isset($validation) && $validation->hasError('sampul')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('sampul'); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <br>
                <button type="submit" class="btn btn-primary"><?= $books['sampul']; ?></button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>