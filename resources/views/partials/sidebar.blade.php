
    <style>
        .sidebar a {
            display: flex;
            align-items: center;
            gap: 15px;
            color: #fff;
        }

        .sidebar.collapsed {
            width: 70px;
        }

        .sidebar.collapsed h4 {
            display: none;
        }

        .sidebar.collapsed a span {
            display: none;
        }

        .sidebar.collapsed a {
            justify-content: center;
        }

    </style>


<div id="content">
    <div id="sidebar" class="sidebar">

        <h4 class="text-center text-white py-2 border-bottom">
            HRMS
        </h4>

        <a href="{{ url('/hr') }}">
            <i class="fas fa-home"></i>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('employee.index') }}">
            <i class="fas fa-users"></i>
            <span>Employees</span>
        </a>

        <a href="{{ route('employee.qualification.store') }}">
            <i class="fas fa-user-graduate"></i>
            <span>Emp Qualification</span>
        </a>

        <a href="{{ route('hr.dept-list') }}">
            <i class="fas fa-building"></i>
            <span>Departments</span>
        </a>

        <a href="{{ route('attendance.index') }}">
            <i class="fas fa-calendar-check"></i>
            <span>Attendance</span>
        </a>

        <a href="{{ route('leave.index') }}">
            <i class="fas fa-file-alt"></i>
            <span>Leave Application</span>
        </a>

        <a href="{{ route('job.index') }}">
            <i class="fas fa-briefcase"></i>
            <span>Jobs</span>
        </a>

    </div>
</div>
