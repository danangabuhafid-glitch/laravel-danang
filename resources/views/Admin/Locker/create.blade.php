<!-- Create Locker Modal -->
<div class="modal fade text-left" id="createLockerModal" tabindex="-1" role="dialog" aria-labelledby="createLockerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createLockerModalLabel">Create New Locker</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('locker.store') }}" method="POST" class="form form-horizontal">
                @csrf
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <!-- Locker Code -->
                            <div class="col-md-4">
                                <label for="locker_code">Locker Code</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="text" id="locker_code" name="locker_code" class="form-control locker-code-input" placeholder="Locker Code" required>
                                        <div class="form-control-icon">
                                            <i class="bi bi-box"></i>
                                        </div>
                                    </div>
                                    <div class="locker-code-feedback mt-1 small" style="display: none;"></div>
                                </div>
                            </div>

                            <!-- Locker Name -->
                            <div class="col-md-4">
                                <label for="locker_name">Owner Name</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="text" id="locker_name" name="locker_name" class="form-control" placeholder="Locker Name">
                                        <div class="form-control-icon">
                                            <i class="bi bi-box"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Locker Description -->
                            <div class="col-md-4">
                                <label for="locker_description">Locker Description</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="text" id="locker_description" name="locker_description" class="form-control" placeholder="Locker Description">
                                        <div class="form-control-icon">
                                            <i class="bi bi-box"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Major -->
                            <div class="col-md-4">
                                <label for="major">Major</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <select name="major" id="major" class="form-select ps-5" required>
                                            <option value="">Select Major</option>
                                            <option value="Web Programming">Web Programming</option>
                                            <option value="Multimedia">Multimedia</option>
                                            <option value="Teknik Jaringan">Teknik Jaringan</option>
                                        </select>
                                        <div class="form-control-icon">
                                            <i class="bi bi-bookmark"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Locker Status -->
                            <div class="col-md-4">
                                <label for="locker_status">Locker Status</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <select name="locker_status" id="locker_status" class="form-select ps-5" required>
                                            <option value="">Select Locker Status</option>
                                            <option value="Available">Available</option>
                                            <option value="Unavailable">Unavailable</option>
                                            <option value="Damaged">Damaged</option>
                                            <option value="Missing">Missing</option>
                                        </select>
                                        <div class="form-control-icon">
                                            <i class="bi bi-toggle-on"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Batch -->
                            <div class="col-md-4">
                                <label for="batch">Batch</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <select name="batch" id="batch" class="form-select ps-5" required>
                                            <option value="">Select Batch</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                        <div class="form-control-icon">
                                            <i class="bi bi-layers"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create Locker</button>
                </div>
            </form>
        </div>
    </div>
</div>