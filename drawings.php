<?php include 'header.php'; if (!isset($_SESSION[ 'email'])) { header( "Location: index.php"); die(); } ?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Build Drawings</h3>
            </div>
            <?php $files=F ile::all(); foreach ($files as $file) { ?>
            <div style="" class="col-lg-3 col-md-4 col-xs-6 thumb text-center file-box">
                <a target="_blank" href="<?php echo './'.$file->path; ?>"><img width="100px" src="vendor/img/icon.jpg" />
                    <p>
                        <?php echo $file->name; ?></p>
                </a>
                <hr/>
                <p class="small file-box-description">
                    <?php echo $file->description; ?></p>
                <p class="small file-box-footer">
                    <a>Edit</a> &nbsp &nbsp <a>Delete</a>
                </p>
            </div>
            <?php } if (sizeof($files)<=1 2) { ?>
            <div style="height:200px;" class="col-lg-3 col-md-4 col-xs-6 thumb">
                <form method="post" class="form form-inline" enctype="multipart/form-data">
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label>File Name</label>
                            <input type="text" name="file_name" class="form-control" required placeholder="Enter file name">
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label>Description</label>
                            <input type="text" name="description" class="form-control" required placeholder="Enter description">
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label>File</label>
                            <input type="file" name="file" accept="application/pdf,application/vnd.ms-excel" class="form-control" required>
                        </div>
                    </div>
                    <br>
                    <div id="success">
                        <?php if (isset($_REQUEST[ "upload"])) { if ($_REQUEST[ "file_name"] !="" && $_REQUEST[ "description"] !="" && $_FILES[ 'file'][ 'name']) { try { move_uploaded_file($_FILES[ 'file'][ 'tmp_name'], 'uploads/'.$_FILES[ 'file'][ 'name']); File::create(array( "name"=>$_REQUEST["file_name"], "description"=>$_REQUEST["description"] , "path"=> 'uploads/'.$_FILES['file']['name'] )); echo '
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12" style="margin-top:20px">
                                <div class="alert alert-success alert-success ">
                                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                                    <strong>Sucess!</strong>File uploaded sucessfully.
                                </div>
                            </div>
                        </div>'; header("Refresh: 0.1;url=drawings.php"); } catch (Exception $ex) { error_log($ex); echo '
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12" style="margin-top:20px">
                                <div class="alert alert-danger alert-error ">
                                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                                    <strong>Error!</strong> There was an error.
                                </div>
                            </div>
                        </div>'; } } else { echo '
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12" style="margin-top:20px">
                                <div class="alert alert-danger alert-error ">
                                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                                    <strong>Error!</strong> Please Enter all the fields.
                                </div>
                            </div>
                        </div>'; } } ?>
                    </div>
                    <div class="row">
                        <div class="form-group col-xs-12">
                            <button type="submit" name="upload" class="btn btn-success btn-lg button">Upload</button>
                        </div>
                    </div>
                </form>
                <?php }?>
            </div>
        </div>
    </div>
</section>
<?php include 'footer.php'; ?>
