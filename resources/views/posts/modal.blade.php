<!-- Bootstrap Icons CDN (Optional for icons) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

<!-- Modal -->
<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <form id="postForm" class="w-100 needs-validation" novalidate>
      <div class="modal-content border-0 shadow-lg rounded-4">
        
        <!-- Modal Header -->
        <div class="modal-header bg-primary text-white rounded-top-4">
          <h5 class="modal-title d-flex align-items-center" id="formModalLabel">
            <i class="bi bi-pencil-square me-2 fs-4"></i> Post Form
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- Modal Body -->
        <div class="modal-body bg-light px-4 py-3">
          @csrf
          <input type="hidden" name="_method" value="POST" id="methodInput">
          
          <div class="mb-3">
            <label for="title" class="form-label fw-semibold">Title</label>
            <input type="text" class="form-control form-control-lg rounded-3" id="title" name="title" placeholder="Enter title" required>
            <div class="invalid-feedback">Title is required.</div>
          </div>

          <div class="mb-3">
            <label for="content" class="form-label fw-semibold">Content</label>
            <textarea class="form-control rounded-3" id="content" name="content" rows="4" placeholder="Enter content" required></textarea>
            <div class="invalid-feedback">Content is required.</div>
          </div>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer bg-white rounded-bottom-4">
          <button type="submit" class="btn btn-success px-4">
            <i class="bi bi-save me-1"></i> Save
          </button>
          <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">
            <i class="bi bi-x-circle me-1"></i> Cancel
          </button>
        </div>

      </div>
    </form>
  </div>
</div>
