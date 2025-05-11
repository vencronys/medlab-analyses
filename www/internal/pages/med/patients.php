<?php
$pageTitle = 'Patient Management';

// Dashboard content
$content = <<<HTML
<div class="container-fluid">
    <!-- Search and Filter Section -->
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form class="row g-3">
                        <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="Search by name or CIN">
                        </div>
                        <div class="col-md-3">
                            <select class="form-select">
                                <option value="">Filter by Gender</option>
                                <option value="M">Male</option>
                                <option value="F">Female</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input type="date" class="form-control" placeholder="Date of Birth">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="d-grid gap-2">
                <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#viewPatientHistoryModal">
                    <i class="bi bi-clock-history"></i> View Patient History
                </button>
                <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#newAnalysisModal">
                    <i class="bi bi-plus-circle"></i> New Analysis
                </button>
            </div>
        </div>
    </div>

    <!-- Patients Table -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>CIN</th>
                            <th>Full Name</th>
                            <th>Date of Birth</th>
                            <th>Gender</th>
                            <th>Phone</th>
                            <th>Last Visit</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>A123456</td>
                            <td>John Doe</td>
                            <td>1985-03-15</td>
                            <td>M</td>
                            <td>0612345678</td>
                            <td>2025-05-01</td>
                            <td><span class="badge bg-success">Active</span></td>
                            <td>
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#patientDetailsModal">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#newAnalysisModal">
                                    <i class="bi bi-plus-circle"></i>
                                </button>
                                <button class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#viewPatientHistoryModal">
                                    <i class="bi bi-clock-history"></i>
                                </button>
                            </td>
                        </tr>
                        <!-- Add more patient rows here -->
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <nav aria-label="Page navigation" class="mt-4">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1">Previous</a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<!-- Patient Details Modal -->
<div class="modal fade" id="patientDetailsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Patient Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="mb-3">Personal Information</h6>
                        <p><strong>Full Name:</strong> John Doe</p>
                        <p><strong>CIN:</strong> A123456</p>
                        <p><strong>Date of Birth:</strong> 1985-03-15</p>
                        <p><strong>Gender:</strong> Male</p>
                        <p><strong>Phone:</strong> 0612345678</p>
                        <p><strong>Address:</strong> 123 Main St, City</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="mb-3">Medical Information</h6>
                        <p><strong>Blood Type:</strong> A+</p>
                        <p><strong>Allergies:</strong> None</p>
                        <p><strong>Last Visit:</strong> 2025-05-01</p>
                        <p><strong>Status:</strong> <span class="badge bg-success">Active</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Patient History Modal -->
<div class="modal fade" id="viewPatientHistoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Patient History</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-4">
                    <select class="form-select mb-3">
                        <option value="">Select Patient</option>
                        <option value="1">John Doe - A123456</option>
                        <option value="2">Jane Smith - B789012</option>
                    </select>
                </div>
                
                <ul class="nav nav-tabs" id="historyTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="analyses-tab" data-bs-toggle="tab" href="#analyses">Analyses</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="appointments-tab" data-bs-toggle="tab" href="#appointments">Appointments</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="prescriptions-tab" data-bs-toggle="tab" href="#prescriptions">Prescriptions</a>
                    </li>
                </ul>
                
                <div class="tab-content mt-3">
                    <div class="tab-pane fade show active" id="analyses">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Results</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>2025-05-01</td>
                                        <td>Blood Test</td>
                                        <td><span class="badge bg-success">Completed</span></td>
                                        <td><button class="btn btn-sm btn-primary">View</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="appointments">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Purpose</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>2025-05-01</td>
                                        <td>Regular Checkup</td>
                                        <td><span class="badge bg-success">Completed</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="prescriptions">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Description</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>2025-05-01</td>
                                        <td>General Prescription</td>
                                        <td><button class="btn btn-sm btn-primary">View</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- New Analysis Modal -->
<div class="modal fade" id="newAnalysisModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Analysis</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="patientSelect" class="form-label">Patient</label>
                        <select class="form-select" id="patientSelect" required>
                            <option value="">Select Patient</option>
                            <option value="1">John Doe - A123456</option>
                            <option value="2">Jane Smith - B789012</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="analysisType" class="form-label">Analysis Type</label>
                        <select class="form-select" id="analysisType" required>
                            <option value="">Select Analysis Type</option>
                            <option value="blood">Blood Test</option>
                            <option value="urine">Urine Analysis</option>
                            <option value="covid">COVID-19 Test</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="scheduledTime" class="form-label">Scheduled Time</label>
                        <input type="datetime-local" class="form-control" id="scheduledTime" required>
                    </div>
                    <div class="mb-3">
                        <label for="notes" class="form-label">Notes</label>
                        <textarea class="form-control" id="notes" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Schedule Analysis</button>
            </div>
        </div>
    </div>
</div>
HTML;

// Include the dashboard template
require_once '../../includes/dashboard-template.php';
