<?php
$pageTitle = 'Medical Dashboard';

// Dashboard content
$content = <<<HTML
<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Today's Patients</h5>
                <p class="card-text display-4">8</p>
                <a href="patients.php" class="btn btn-primary btn-sm">View Schedule</a>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Pending Analyses</h5>
                <p class="card-text display-4">12</p>
                <a href="analyses.php" class="btn btn-primary btn-sm">View Analyses</a>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Completed Today</h5>
                <p class="card-text display-4">5</p>
                <a href="analyses.php?status=completed" class="btn btn-primary btn-sm">View Results</a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Recent Patients</h5>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Patient</th>
                                <th>Analysis Type</th>
                                <th>Time</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>John Doe</td>
                                <td>Blood Test</td>
                                <td>10:00 AM</td>
                                <td><span class="badge bg-success">Completed</span></td>
                            </tr>
                            <tr>
                                <td>Jane Smith</td>
                                <td>Urine Analysis</td>
                                <td>11:30 AM</td>
                                <td><span class="badge bg-warning">Pending</span></td>
                            </tr>
                            <tr>
                                <td>Robert Johnson</td>
                                <td>X-Ray</td>
                                <td>2:00 PM</td>
                                <td><span class="badge bg-primary">Scheduled</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Quick Actions</h5>
                <div class="d-grid gap-2">
                    <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#newAnalysisModal">
                        <i class="bi bi-plus-circle"></i> New Analysis
                    </button>
                    <button class="btn btn-outline-primary" type="button">
                        <i class="bi bi-search"></i> Search Patient History
                    </button>
                    <button class="btn btn-outline-secondary" type="button">
                        <i class="bi bi-file-text"></i> Generate Report
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- New Analysis Modal -->
<div class="modal fade" id="newAnalysisModal" tabindex="-1" aria-labelledby="newAnalysisModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newAnalysisModalLabel">New Analysis</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="patientName" class="form-label">Patient Name</label>
                        <input type="text" class="form-control" id="patientName" required>
                    </div>
                    <div class="mb-3">
                        <label for="analysisType" class="form-label">Analysis Type</label>
                        <select class="form-select" id="analysisType" required>
                            <option value="">Select Analysis Type</option>
                            <option value="blood">Blood Test</option>
                            <option value="urine">Urine Analysis</option>
                            <option value="xray">X-Ray</option>
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
