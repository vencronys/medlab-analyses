<?php
$pageTitle = 'Secretary Dashboard';

// Dashboard content
$content = <<<HTML
<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Today's Appointments</h5>
                <p class="card-text display-4">12</p>
                <a href="rdv.php" class="btn btn-primary btn-sm">View Schedule</a>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Pending Results</h5>
                <p class="card-text display-4">8</p>
                <a href="results.php" class="btn btn-primary btn-sm">View Results</a>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Registered Patients</h5>
                <p class="card-text display-4">150</p>
                <a href="patients.php" class="btn btn-primary btn-sm">View Patients</a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Today's Schedule</h5>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Time</th>
                                <th>Patient</th>
                                <th>Type</th>
                                <th>Doctor</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>09:00 AM</td>
                                <td>Sarah Wilson</td>
                                <td>Blood Test</td>
                                <td>Dr. Smith</td>
                                <td><span class="badge bg-success">Confirmed</span></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary">Edit</button>
                                    <button class="btn btn-sm btn-outline-danger">Cancel</button>
                                </td>
                            </tr>
                            <tr>
                                <td>10:30 AM</td>
                                <td>Michael Brown</td>
                                <td>X-Ray</td>
                                <td>Dr. Johnson</td>
                                <td><span class="badge bg-warning">Pending</span></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary">Edit</button>
                                    <button class="btn btn-sm btn-outline-danger">Cancel</button>
                                </td>
                            </tr>
                            <tr>
                                <td>02:00 PM</td>
                                <td>Emma Davis</td>
                                <td>General Checkup</td>
                                <td>Dr. Wilson</td>
                                <td><span class="badge bg-primary">Arrived</span></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary">Edit</button>
                                    <button class="btn btn-sm btn-outline-danger">Cancel</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Quick Actions</h5>
                <div class="d-grid gap-2">
                    <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#newAppointmentModal">
                        <i class="bi bi-calendar-plus"></i> New Appointment
                    </button>
                    <button class="btn btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#newPatientModal">
                        <i class="bi bi-person-plus"></i> Register Patient
                    </button>
                    <button class="btn btn-outline-secondary" type="button">
                        <i class="bi bi-telephone"></i> Call Patient
                    </button>
                </div>
            </div>
        </div>
        
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Reminders</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Call Mr. Johnson
                        <span class="badge bg-primary rounded-pill">Now</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Confirm tomorrow's appointments
                        <span class="badge bg-warning rounded-pill">Today</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Send lab results
                        <span class="badge bg-info rounded-pill">Today</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- New Appointment Modal -->
<div class="modal fade" id="newAppointmentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Schedule New Appointment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="patientName" class="form-label">Patient Name</label>
                        <input type="text" class="form-control" id="patientName" required>
                    </div>
                    <div class="mb-3">
                        <label for="appointmentType" class="form-label">Appointment Type</label>
                        <select class="form-select" id="appointmentType" required>
                            <option value="">Select Type</option>
                            <option value="general">General Checkup</option>
                            <option value="blood">Blood Test</option>
                            <option value="xray">X-Ray</option>
                            <option value="followup">Follow-up</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="doctor" class="form-label">Doctor</label>
                        <select class="form-select" id="doctor" required>
                            <option value="">Select Doctor</option>
                            <option value="smith">Dr. Smith</option>
                            <option value="johnson">Dr. Johnson</option>
                            <option value="wilson">Dr. Wilson</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="appointmentDate" class="form-label">Date & Time</label>
                        <input type="datetime-local" class="form-control" id="appointmentDate" required>
                    </div>
                    <div class="mb-3">
                        <label for="notes" class="form-label">Notes</label>
                        <textarea class="form-control" id="notes" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Schedule Appointment</button>
            </div>
        </div>
    </div>
</div>

<!-- New Patient Modal -->
<div class="modal fade" id="newPatientModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Register New Patient</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="newPatientName" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="newPatientName" required>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="dateOfBirth" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" id="dateOfBirth" required>
                        </div>
                        <div class="col">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-select" id="gender" required>
                                <option value="">Select Gender</option>
                                <option value="M">Male</option>
                                <option value="F">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="tel" class="form-control" id="phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" id="address" rows="2"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="medicalHistory" class="form-label">Medical History</label>
                        <textarea class="form-control" id="medicalHistory" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Register Patient</button>
            </div>
        </div>
    </div>
</div>
HTML;

// Include the dashboard template
require_once '../../includes/dashboard-template.php';
