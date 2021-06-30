   <div class="modal fade bs-example-modal-sm" id="loginModal"tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-sm">
                                <div class="modal-content wow fadeInDown">
                                <div class="modal-header">
                               <h4 class="wow fadeInDown"> Petshop Online Website</h4>
                                
                                </div>
                               <br />
                               <center><i class="fa fa-user"></i> Welcome Admin</center>
                                <form class="form-horizontal wow fadeInDown" method="POST" action="adminlogin_process.php">
                                        <div class="form-group">
                                            <label for="name" class="col-sm-4 control-label wow fadeInDown">Username</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control wow fadeInDown" id="name" name="username" placeholder="Enter Username" onKeyPress="return isNotAlphanumeric(event)" required />
                                            </div>
                                        </div> 
                                        <div class="form-group">
                                            <label for="name" class="col-sm-4 control-label wow fadeInDown">Password</label>
                                            <div class="col-sm-6">
                                                <input type="password" class="form-control wow fadeInDown" id="name" name="password" placeholder="Enter Password" onKeyPress="return isNotAlphanumeric(event)" required>
                                            </div>
                                        </div> 
                                            <div class="modal-footer wow fadeInDown" style="padding-right:110px;">
                                                <button type="submit" class="btn btn-info wow fadeInDown"><span class="glyphicon glyphicon-log-in"></span> Login</button>
                                                 <button type="reset" class="btn btn-default wow fadeInDown">Clear</button>
                                                <button type="button" class="btn btn-danger wow fadeInDown" data-dismiss="modal">Close</button>
                                        </div>
                                  </form>
                                </div>
                              </div>
                            </div>