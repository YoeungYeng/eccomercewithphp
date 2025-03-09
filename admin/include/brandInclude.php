<div class="body-wrapper p-3"  >
    <div class="card shadow-lg" style="margin-top: 120px;">
        <div class="card-header bg-primary text-white" style="margin-top: -30px;">
            <h4 class="mb-0">Brand Form</h4>
        </div>
        <div class="card-body">
            <form>
                <!-- Brand Name -->
                <div class="mb-3">
                    <label for="brandName" class="form-label">Brand Name</label>
                    <input type="text" class="form-control" id="brandName" placeholder="Enter brand name" required>
                </div>

                <!-- Brand Logo Upload -->
                <div class="mb-3">
                    <label for="brandLogo" class="form-label">Brand Logo</label>
                    <input type="file" class="form-control" id="brandLogo" required>
                </div>

                <!-- Brand Description -->
                <div class="mb-3">
                    <label for="brandDescription" class="form-label">Description</label>
                    <textarea class="form-control" id="brandDescription" rows="3" placeholder="Enter brand description"></textarea>
                </div>

                <!-- Status Dropdown -->
                <div class="mb-3">
                    <label for="brandStatus" class="form-label">Status</label>
                    <select class="form-select" id="brandStatus" required>
                        <option value="" selected disabled>Select status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>

                <!-- Submit and Reset Buttons -->
                <div class="d-flex justify-content-end">
                    <button type="reset" class="btn btn-secondary me-2">Reset</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>