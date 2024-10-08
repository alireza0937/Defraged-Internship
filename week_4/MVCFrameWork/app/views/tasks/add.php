<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo URLROOT; ?>" class="btn btn-light"><i class="fa fa-backward" aria-hidden="true"></i> Back</a>
      <div class="card card-body bg-light mt-5">
        <h2>Add Task</h2>
        <p>Create a Task with this form</p>
        <form action="<?php echo URLROOT; ?>/tasks/add" method="post">
          <div class="form-group">
              <label>Title:<sup>*</sup></label>
              <input type="text" name="title" class="form-control form-control-lg" value="" placeholder="Add a title...">
              <span class="invalid-feedback"><?php echo $data['title_err']; ?></span>
          </div>    
          <div class="form-group">
              <label>Description:<sup>*</sup></label>
              <textarea name="description" class="form-control form-control-lg" placeholder="Add some text..."></textarea>
              <span class="invalid-feedback"><?php echo $data['body_err']; ?></span>
          </div>
          <input type="submit" class="btn btn-success" value="Submit">
        </form>
      </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
