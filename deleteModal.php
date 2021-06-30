<!-- Modal -->
<div class="modal fade" id="deleteModal<?php echo $id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="glyphicon glyphicon-exclamation-sign"></i> CONFIRMATION</h4>
      </div>
      <form method="post" action="deletemodalprocess.php">
      <div class="modal-body">
       <h3>Are you sure your want to delete <strong style="color:red;"><u><?php echo $name;?></u>?</strong></h3>
       <input type="hidden" name="id" value="<?php echo $id?>">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" name="delete" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
      </div>
      </form>
    </div>
  </div>
</div>