<?php require_once 'crms_header.php';?>
    <div class="content-wrapper">
        <!--div class="row" id="proBanner">
            <div class="col-12">
                <span class="d-flex align-items-center purchase-popup">
                  <p>Get tons of UI components, Plugins, multiple layouts, 20+ sample pages, and more!</p>
                  <a href="" class="btn download-button purchase-button ml-auto">Upgrade To Pro</a>
                  <i class="mdi mdi-close" id="bannerClose"></i>
                </span>
            </div>
        </div-->

        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-shield-half-full"></i>
                </span> Guarantor </h3>
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="row">

            <!-- add guarantor form start-->
                <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title text-danger mb-5">Add Guarantor details</h4>
                    <form class="forms-sample">
                        <div class="form-group">
                            <label for="guarantorID"><b>Reserved ID</b></label>
                            <select class="custom-select" name="guarantorID">
                                <option value="">Select Reserved ID</option>
                            </select>
                        </div>
                      <div class="form-group">
                        <label for="guarantorName">Name</label>
                        <input type="text" class="form-control" id="guarantorName" placeholder="Name">
                      </div>
                      <div class="form-group">
                        <label for="guarantorNIC">NIC</label>
                        <input type="password" class="form-control" id="guarantorNIC" placeholder="NIC">
                      </div>
                      <div class="form-group">
                        <label for="guarantorPhone">Phone</label>
                        <input type="email" class="form-control" id="guarantorPhone" placeholder="Phone">
                      </div>
                      <div class="form-group">
                        <label for="guarantorAddress">Address</label>
                        <textarea class="form-control" id="guarantorAddress" rows="4" placeholder="Phone"> </textarea>
                      </div>
                      <div class="form-group">
                        <label>License Copy</label>
                        <input type="file" name="img[]" class="file-upload-default">
                        <div class="input-group col-xs-12">
                          <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                          <span class="input-group-append">
                            <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                          </span>
                        </div>
                      </div>
                      <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                      <button class="btn btn-light">Cancel</button>
                    </form>
                  </div>
                </div>
              </div>
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-danger">Guarantor Details</h4></p>
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Reserved ID</th>
                                <th>Name</th>
                                <th>NIC</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>License Copy</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Jacob</td>
                                <td>Photoshop</td>
                                <td class="text-danger"> 28.76% <i class="mdi mdi-arrow-down"></i></td>
                                <td><label class="badge badge-danger">Pending</label></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- content-wrapper ends -->
<?php require_once 'crms_footer.php';?>