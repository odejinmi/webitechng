@extends('admin.layouts.app')
@section('panel')

{{--@section('title', 'Send Notifications')--}}

{{--@section('content')--}}
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Send Firebase Notifications</h3>
                </div>
                <div class="card-body">
                    <!-- Notification Form Tabs -->
                    <ul class="nav nav-tabs" id="notificationTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="single-user-tab" data-bs-toggle="tab" data-bs-target="#single-user" type="button" role="tab">
                                Single User
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="multiple-users-tab" data-bs-toggle="tab" data-bs-target="#multiple-users" type="button" role="tab">
                                Multiple Users
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="all-users-tab" data-bs-toggle="tab" data-bs-target="#all-users" type="button" role="tab">
                                All Users
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content" id="notificationTabsContent">
                        <!-- Single User Tab -->
                        <div class="tab-pane fade show active" id="single-user" role="tabpanel">
                            <form id="singleUserForm" class="mt-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="user_id" class="form-label">Select User</label>
                                            <select class="form-select" id="user_id" name="user_id" required>
                                                <option value="">Choose a user...</option>
                                                @foreach($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name ?? $user->email }} ({{ $user->email }})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="single_title" class="form-label">Title</label>
                                            <input type="text" class="form-control" id="single_title" name="title" required maxlength="255">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="single_body" class="form-label">Message</label>
                                            <textarea class="form-control" id="single_body" name="body" rows="3" required maxlength="1000"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Additional Data (JSON)</label>
                                    <textarea class="form-control" id="single_data" name="data" rows="3" placeholder='{"key": "value"}'></textarea>
                                    <small class="text-muted">Optional: Add custom data in JSON format</small>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-paper-plane"></i> Send Notification
                                </button>
                            </form>
                        </div>

                        <!-- Multiple Users Tab -->
                        <div class="tab-pane fade" id="multiple-users" role="tabpanel">
                            <form id="multipleUsersForm" class="mt-3">
                                <div class="mb-3">
                                    <label class="form-label">Select Users</label>
                                    <div class="row">
                                        @foreach($users as $user)
                                        <div class="col-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="{{ $user->id }}" id="user_{{ $user->id }}" name="user_ids[]">
                                                <label class="form-check-label" for="user_{{ $user->id }}">
                                                    {{ $user->name ?? $user->email }}
                                                </label>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="mt-2">
                                        <button type="button" class="btn btn-sm btn-outline-primary" onclick="selectAllUsers()">Select All</button>
                                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="deselectAllUsers()">Deselect All</button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="multiple_title" class="form-label">Title</label>
                                            <input type="text" class="form-control" id="multiple_title" name="title" required maxlength="255">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="multiple_body" class="form-label">Message</label>
                                            <textarea class="form-control" id="multiple_body" name="body" rows="3" required maxlength="1000"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Additional Data (JSON)</label>
                                    <textarea class="form-control" id="multiple_data" name="data" rows="3" placeholder='{"key": "value"}'></textarea>
                                    <small class="text-muted">Optional: Add custom data in JSON format</small>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-paper-plane"></i> Send to Selected Users
                                </button>
                            </form>
                        </div>

                        <!-- All Users Tab -->
                        <div class="tab-pane fade" id="all-users" role="tabpanel">
                            <form id="allUsersForm" class="mt-3">
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle"></i> This will send notification to all users with FCM tokens ({{ $users->count() }} users)
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="all_title" class="form-label">Title</label>
                                            <input type="text" class="form-control" id="all_title" name="title" required maxlength="255">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="all_body" class="form-label">Message</label>
                                            <textarea class="form-control" id="all_body" name="body" rows="3" required maxlength="1000"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Additional Data (JSON)</label>
                                    <textarea class="form-control" id="all_data" name="data" rows="3" placeholder='{"key": "value"}'></textarea>
                                    <small class="text-muted">Optional: Add custom data in JSON format</small>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-paper-plane"></i> Send to All Users
                                </button>
                            </form>
                        </div>

                        <!-- Username/Topic Tab -->
                        <div class="tab-pane fade" id="username" role="tabpanel">
                            <form id="usernameForm" class="mt-3">
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle"></i> Send notification to a specific username as a topic (e.g., "Adeolu23")
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="username_name" class="form-label">Username/Topic</label>
                                            <input type="text" class="form-control" id="username_name" name="username" required maxlength="255" placeholder="e.g., Adeolu23">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="username_title" class="form-label">Title</label>
                                            <input type="text" class="form-control" id="username_title" name="title" required maxlength="255">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="username_body" class="form-label">Message</label>
                                            <textarea class="form-control" id="username_body" name="body" rows="3" required maxlength="1000"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Additional Data (JSON)</label>
                                    <textarea class="form-control" id="username_data" name="data" rows="3" placeholder='{"key": "value"}'></textarea>
                                    <small class="text-muted">Optional: Add custom data in JSON format</small>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-paper-plane"></i> Send to Username
                                </button>
                            </form>
                        </div>

                        <!-- Topic Tab -->
                        <div class="tab-pane fade" id="topic" role="tabpanel">
                            <form id="topicForm" class="mt-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="topic_name" class="form-label">Topic Name</label>
                                            <input type="text" class="form-control" id="topic_name" name="topic" required maxlength="255" placeholder="e.g., news, updates, promotions">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="topic_title" class="form-label">Title</label>
                                            <input type="text" class="form-control" id="topic_title" name="title" required maxlength="255">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="topic_body" class="form-label">Message</label>
                                            <textarea class="form-control" id="topic_body" name="body" rows="3" required maxlength="1000"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Additional Data (JSON)</label>
                                    <textarea class="form-control" id="topic_data" name="data" rows="3" placeholder='{"key": "value"}'></textarea>
                                    <small class="text-muted">Optional: Add custom data in JSON format</small>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-paper-plane"></i> Send to Topic
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Results Modal -->
    <div class="modal fade" id="resultsModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Notification Results</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div id="resultsContent"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .tab-content {
        margin-top: 20px;
    }
    .form-check {
        margin-bottom: 0.5rem;
    }
    .notification-result {
        margin-bottom: 10px;
        padding: 10px;
        border-radius: 5px;
    }
    .notification-result.success {
        background-color: #d4edda;
        border: 1px solid #c3e6cb;
        color: #155724;
    }
    .notification-result.error {
        background-color: #f8d7da;
        border: 1px solid #f5c6cb;
        color: #721c24;
    }
</style>
@endpush

@push('script')
<script>

    // Form submission handlers
    document.getElementById('singleUserForm').addEventListener('submit', function(e) {
        e.preventDefault();
        console.log('/admin/firebase/send-to-user');
        sendNotification('/admin/firebase/send-to-user', new FormData(this), this);
    });

    document.getElementById('multipleUsersForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        // Ensure at least one user is selected
        const selectedUsers = document.querySelectorAll('input[name="user_ids[]"]:checked');
        if (selectedUsers.length === 0) {
            alert('Please select at least one user');
            return;
        }
        sendNotification('/admin/firebase/send-to-multiple-users', formData, this);
    });

    document.getElementById('allUsersForm').addEventListener('submit', function(e) {
        e.preventDefault();
        if (!confirm('Are you sure you want to send this notification to all users?')) {
            return;
        }
        sendNotification('/admin/firebase/send-to-all-users', new FormData(this), this);
    });

    function sendNotification(url, formData, formElement) {

        console.log(url);
        // Parse JSON data if provided
        const dataField = formData.get('data');
        if (dataField && dataField.trim()) {
            try {
                JSON.parse(dataField);
            } catch (e) {
                alert('Invalid JSON format in Additional Data field');
                return;
            }
        }

        // Show loading and prevent double submission
        const submitBtn = formElement.querySelector('button[type="submit"]');
        
        // Check if already submitting
        if (submitBtn.disabled) {
            return;
        }

        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
        submitBtn.disabled = true;

        fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            showResults(data);
        })
        .catch(error => {
            console.error('Error:', error);
            showResults({success: false, message: 'Network error occurred'});
        })
        .finally(() => {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        });
    }

    function showResults(data) {
        const resultsContent = document.getElementById('resultsContent');
        let html = '';

        if (data.success) {
            html += '<div class="alert alert-success">Notification sent successfully!</div>';

            if (data.results && Array.isArray(data.results)) {
                html += '<h6>Individual Results:</h6>';
                data.results.forEach(result => {
                    const statusClass = result.result.success ? 'success' : 'error';
                    const statusText = result.result.success ? 'Success' : 'Error';
                    const message = result.result.success ? 'Sent successfully' : result.result.error;

                    html += `<div class="notification-result ${statusClass}">
                        <strong>${statusText}:</strong> ${message}
                    </div>`;
                });
            }

            if (data.total_sent) {
                html += `<div class="mt-3"><strong>Total notifications sent:</strong> ${data.total_sent}</div>`;
            }
        } else {
            html += '<div class="alert alert-danger">Failed to send notification!</div>';
            if (data.message) {
                html += `<div class="mt-2"><strong>Error:</strong> ${data.message}</div>`;
            }
            if (data.errors) {
                html += '<div class="mt-2"><strong>Validation Errors:</strong><ul>';
                Object.values(data.errors).forEach(errors => {
                    errors.forEach(error => {
                        html += `<li>${error}</li>`;
                    });
                });
                html += '</ul></div>';
            }
        }

        resultsContent.innerHTML = html;
        const modal = new bootstrap.Modal(document.getElementById('resultsModal'));
        modal.show();
    }

    function selectAllUsers() {
        document.querySelectorAll('input[name="user_ids[]"]').forEach(checkbox => {
            checkbox.checked = true;
        });
    }

    function deselectAllUsers() {
        document.querySelectorAll('input[name="user_ids[]"]').forEach(checkbox => {
            checkbox.checked = false;
        });
    }
</script>
@endpush
