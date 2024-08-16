<?php require APPROOT . '/views/inc/header.php'; ?>
  <div class="row mb-3">
    <div class="col-md-6">
      <h1>Tasks</h1>
    </div>
    <div class="col-md-6">
      <a href="<?php echo URLROOT; ?>/tasks/add" class="btn btn-primary pull-right">
        <i class="fa fa-pencil"></i> Add Task
      </a>
    </div>
  </div>
  <?php foreach($data['tasks'] as $tasks) : ?>
    <div class="card card-body mb-3">
      <h4 class="card-title"><?php echo $tasks->title; ?></h4>
        
      <div class="bg-light p-2 mb-3">
        Task Status: 
        <form action="" method="post">
            <select name="status">
                <option value="1_<?php echo $tasks->id ?>" <?php echo $tasks->is_done ? 'selected' : ''; ?> >Done</option>
                <option value="0_<?php echo $tasks->id ?>" <?php echo !$tasks->is_done ? 'selected' : ''; ?> >Not Done</option>
            </select>
            <button>Set</button>
        </form>
      </div>
      <p class="card-text"><?php echo $tasks->description; ?></p>
      <a href="<?php echo URLROOT; ?>/tasks/delete/<?php echo $tasks->id; ?>" class="btn btn-dark">Delete</a>
    </div>
  <?php endforeach; ?>

<?php require APPROOT . '/views/inc/footer.php'; ?>