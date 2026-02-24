<?= $this->extend('theme/template') ?>

<?= $this->section('content') ?>
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Subjects</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
            <li class="breadcrumb-item active">Subjects</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">List of Subjects</h3>
              <div class="float-right">
                <button type="button" class="btn btn-md btn-primary" data-toggle="modal" data-target="#AddSubjectModal">
                  <i class="fa fa-plus-circle fa fw"></i> Add New
                </button>
              </div>
            </div>
            <div class="card-body">
               <table id="subjectTable" class="table table-bordered table-striped table-sm">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th style="display:none;">id</th>
                    <th>Subject Code</th>
                    <th>Subject Name</th>
                    <th>Description</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="AddSubjectModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <form id="addSubjectForm">
          <?= csrf_field() ?>
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title"><i class="fa fa-plus-circle fa fw"></i> Add New Subject</h5>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label>Subject Code</label>
                <input type="text" name="code" class="form-control" required placeholder="e.g. IT101" />
              </div>
              <div class="form-group">
                <label>Subject Name</label>
                <input type="text" name="name" class="form-control" required placeholder="e.g. Introduction to Programming" />
              </div>
              <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="form-control" rows="3" placeholder="Optional details..."></textarea>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class='fas fa-times-circle'></i> Cancel</button>
              <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <div class="modal fade" id="editSubjectModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title"><i class="far fa-edit fa fw"></i> Edit Subject</h5>
            <button type="button" class="close" data-dismiss="modal">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="editSubjectForm">
              <?= csrf_field() ?>
            <div class="modal-body">
              <input type="hidden" id="edit_id" name="id">
              <div class="form-group">
                  <label>Subject Code</label>
                  <input type="text" name="code" id="edit_code" class="form-control" required />
              </div>
              <div class="form-group">
                <label>Subject Name</label>
                <input type="text" class="form-control" id="edit_name" name="name" required>
              </div>
              <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" id="edit_description" name="description" rows="3"></textarea>
              </div>        
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class='fas fa-times-circle'></i> Cancel</button>
              <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>
<div class="toasts-top-right fixed" style="position: fixed; top: 1rem; right: 1rem; z-index: 9999;"></div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
$(document).ready(function () {
    const baseUrl = "<?= base_url() ?>";

    let table = $('#subjectTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: baseUrl + 'subject/fetchRecords',
            type: 'POST',
            data: function (d) {
                d.<?= csrf_token() ?> = '<?= csrf_hash() ?>'; 
            }
        },
        columns: [
            { data: 'row_number', orderable: false },
            { data: 'id', visible: false },
            { data: 'code' },
            { data: 'name' },
            { data: 'description' },
            {
                data: null,
                render: function (data, type, row) {
                    return `
                        <button class="btn btn-sm btn-warning edit-btn" data-id="${row.id}">
                            <i class="fas fa-edit" style="color:white;"></i>
                        </button>
                        <button class="btn btn-sm btn-danger delete-btn" data-id="${row.id}">
                            <i class="fas fa-trash"></i>
                        </button>`;
                },
                orderable: false
            }
        ]
    });

    // ==========================================
    // OFFLINE & SYNC LOGIC FOR ADDING SUBJECTS
    // ==========================================
    
    function saveSubjectOffline(formData) {
        let offlineSubjects = JSON.parse(localStorage.getItem('offlineSubjects')) || [];
        offlineSubjects.push(formData);
        localStorage.setItem('offlineSubjects', JSON.stringify(offlineSubjects));
        
        toastr.info('You are offline. Subject saved locally and will sync when online.');
        
        $('#AddSubjectModal').modal('hide');
        $('#addSubjectForm')[0].reset();
        table.draw(false); 
    }

    function syncOfflineSubjects() {
        let offlineSubjects = JSON.parse(localStorage.getItem('offlineSubjects')) || [];
        
        if (offlineSubjects.length > 0) {
            toastr.info('Network restored. Syncing ' + offlineSubjects.length + ' offline subject(s)...');
            
            let remainingSubjects = [];

            // Process each saved subject
            offlineSubjects.forEach(function(formData) {
                $.ajax({
                    url: baseUrl + 'subject/save',
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        if (response.status === 'success') {
                            toastr.success('Offline subject synced successfully!');
                            table.ajax.reload(null, false);
                        } else {
                            toastr.error('Failed to sync a subject: ' + response.message);
                        }
                    },
                    error: function() {
                        // Keep in queue if network fails again during sync
                        remainingSubjects.push(formData);
                    }
                });
            });

            // Update localStorage (clears successful ones, keeps failed ones)
            localStorage.setItem('offlineSubjects', JSON.stringify(remainingSubjects));
        }
    }

    // Listeners for network status
    window.addEventListener('online', syncOfflineSubjects);

    if (navigator.onLine) {
        syncOfflineSubjects();
    }

    // Add Subject Submit Event
    $('#addSubjectForm').submit(function (e) {
        e.preventDefault();
        
        let formData = $(this).serialize();

        if (!navigator.onLine) {
            // Offline path
            saveSubjectOffline(formData);
        } else {
            // Online path
            $.ajax({
                url: baseUrl + 'subject/save',
                type: 'POST',
                data: formData,
                success: function (response) {
                    if (response.status === 'success') {
                        $('#AddSubjectModal').modal('hide');
                        $('#addSubjectForm')[0].reset();
                        table.ajax.reload();
                        toastr.success('Subject added successfully!');
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function() {
                    // Fallback to offline save if request drops mid-submission
                    saveSubjectOffline(formData);
                }
            });
        }
    });

    // ==========================================
    // EXISTING EDIT & DELETE LOGIC
    // ==========================================

    // Fetch Data for Edit
    $('#subjectTable').on('click', '.edit-btn', function () {
        let id = $(this).data('id');
        $.get(baseUrl + 'subject/edit/' + id, function (response) {
            $('#edit_id').val(response.data.id);
            $('#edit_code').val(response.data.code);
            $('#edit_name').val(response.data.name);
            $('#edit_description').val(response.data.description);
            $('#editSubjectModal').modal('show');
        });
    });

    // Update Subject
    $('#editSubjectForm').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: baseUrl + 'subject/update',
            type: 'POST',
            data: $(this).serialize(),
            success: function (response) {
                if (response.success) {
                    $('#editSubjectModal').modal('hide');
                    table.ajax.reload();
                    toastr.success(response.message);
                } else {
                    toastr.error(response.message);
                }
            }
        });
    });

    // Delete Subject
    $('#subjectTable').on('click', '.delete-btn', function () {
        let id = $(this).data('id');
        if (confirm('Are you sure you want to delete this subject?')) {
            $.ajax({
                url: baseUrl + 'subject/delete/' + id,
                type: 'DELETE',
                data: {
                    <?= csrf_token() ?>: '<?= csrf_hash() ?>'
                },
                success: function (response) {
                    if (response.success) {
                        table.ajax.reload();
                        toastr.success(response.message);
                    } else {
                        toastr.error(response.message);
                    }
                }
            });
        }
    });
});
</script>
<?= $this->endSection() ?>