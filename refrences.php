<?php include 'header.php';
  $_SESSION["ACTIVE_PAGE"]= "refrence";
?>

<section id="refrences">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Components</h2>
                <hr class="star-primary">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 portfolio-item" style="height: 300px;">
                <a href="#portfolioModal1" class="portfolio-link" data-toggle="modal">
                    <img src="img/main-layout.jpg" class="img-responsive" alt="">
                </a>
            </div>
            <div class="col-sm-4 portfolio-item" style="height: 300px;">
                <a href="#portfolioModal2" class="portfolio-link" data-toggle="modal">
                    <img src="img/block.jpg" class="img-responsive" alt="">
                </a>
            </div>
            <div class="col-sm-4 portfolio-item" style="height: 300px;">
                <a href="#portfolioModal3" class="portfolio-link" data-toggle="modal">
                    <img src="img/satallite.jpg" class="img-responsive" alt="">
                </a>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-sm-4 portfolio-item" style="height: 300px;">
                <a href="#portfolioModal4" class="portfolio-link" data-toggle="modal">
                    <img src="img/table.jpg" class="img-responsive" alt="">
                </a>
            </div>
            <div class="col-sm-4 portfolio-item" style="height: 300px;">
                <a href="#portfolioModal5" class="portfolio-link" data-toggle="modal">
                    <img src="img/row.jpg" class="img-responsive" alt="">
                </a>
            </div>
            <div class="col-sm-4 portfolio-item" style="height: 300px;">
                <a href="#portfolioModal6" class="portfolio-link" data-toggle="modal">
                    <img src="img/table-layout.jpg" class="img-responsive" alt="">
                </a>
            </div>
        </div>
    </div>
</section>
<!-- Portfolio Modals -->
<div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="modal-body">
                        <h2>Project Layout</h2>
                        <hr class="star-primary">
                        <div class="zoom">
                          <img src="img/main-layout.jpg" class="img-responsive img-centered" alt="">
                        </div>
                        <p>This is the layout of complete project</p>
                        <ul class="list-inline item-details">
                            <li>Blocks:
                                <strong>100</strong>
                            </li>
                            <li>Rows in each block:
                                <strong>13</strong>
                            </li>
                            <li>Tables in each row:
                                <strong>8</strong>
                            </li>
                            <li>Panels in each table:
                                <strong>40</strong>
                            </li>
                        </ul>
                        count starts from top right to left
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="portfolio-modal modal fade" id="portfolioModal2" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="modal-body">
                        <h2>Block Layout</h2>
                        <hr class="star-primary">
                        <div class="zoom">
                          <img src="img/block.jpg" class="img-responsive img-centered" alt="">
                        </div>
                        <p>Each block having 13 rows and number start from top to bottom</p>
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="portfolio-modal modal fade" id="portfolioModal3" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="modal-body">
                        <h2>Sattelite View</h2>
                        <hr class="star-primary">
                        <div class="zoom">
                          <img src="img/satallite.jpg" class="img-responsive img-centered" alt="">
                        </div>
                        <p>Satattlite view</p>
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="portfolio-modal modal fade" id="portfolioModal4" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="modal-body">
                        <h2>Table View</h2>
                        <hr class="star-primary">
                        <img src="img/table.jpg" class="img-responsive img-centered" alt="">
                        <p>8 Table per row and are count from right to left</p>
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="portfolio-modal modal fade" id="portfolioModal5" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="modal-body">
                        <h2>Rows view</h2>
                        <hr class="star-primary">
                        <img src="img/row.jpg" class="img-responsive img-centered" alt="">
                        <p>Each block have 13 row and are counted from top to bottom</p>
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="portfolio-modal modal fade" id="portfolioModal6" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="modal-body">
                        <h2>Project Title</h2>
                        <hr class="star-primary">
                        <img src="img/table-layout.jpg" class="img-responsive img-centered" alt="">
                        <p>Each table have 40 panels with top/bottom positions</p>
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
<script>
  $('.zoom').zoom();
</script>
