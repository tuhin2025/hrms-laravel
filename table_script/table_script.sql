create table contact
(
    id        int auto_increment
        primary key,
    user_name varchar(200) null,
    email     varchar(200) null,
    subject   varchar(200) null,
    message   varchar(200) null,
    insert_dt date         null,
    remarks   varchar(500) null,
    update_dt datetime     null
);

create table emp_attendance
(
    attendance_id   bigint auto_increment
        primary key,
    employee_id     bigint                                not null,
    attendance_date date                                  not null,
    shift_id        bigint                                not null,
    check_in        time                                  null,
    check_out       time                                  null,
    status          varchar(1)                            null,
    working_hours   decimal(5, 2)                         null,
    remarks         varchar(255)                          null,
    created_by      int                                   null,
    created_at      timestamp default current_timestamp() not null,
    updated_by      int                                   null,
    updated_at      timestamp default current_timestamp() not null on update current_timestamp()
);

create index attendance_date
    on emp_attendance (attendance_date);

create index employee_id
    on emp_attendance (employee_id);

create index shift_id
    on emp_attendance (shift_id);

create table jobs
(
    job_id     varchar(20)    not null
        primary key,
    job_title  varchar(50)    null,
    min_salary decimal(10, 2) null,
    max_salary decimal(10, 2) null
);

create table l_leave_type
(
    leave_type_id     int auto_increment
        primary key,
    leave_type_name   varchar(500)               null,
    leave_type_bangla varchar(1000) charset utf8 null
);

create table regions
(
    region_id   int         not null
        primary key,
    region_name varchar(50) null
);

create table countries
(
    country_id   char(2)     not null
        primary key,
    country_name varchar(50) null,
    region_id    int         null,
    constraint countries_ibfk_1
        foreign key (region_id) references regions (region_id)
);

create index region_id
    on countries (region_id);

create table locations
(
    location_id    int          not null
        primary key,
    street_address varchar(100) null,
    postal_code    varchar(20)  null,
    city           varchar(50)  null,
    state_province varchar(50)  null,
    country_id     char(2)      null,
    constraint locations_ibfk_1
        foreign key (country_id) references countries (country_id)
);

create table departments
(
    department_id   int auto_increment
        primary key,
    department_name varchar(50) null,
    manager_id      int         null,
    location_id     int         null,
    constraint departments_ibfk_1
        foreign key (location_id) references locations (location_id)
);

create index location_id
    on departments (location_id);

create table employees
(
    employee_id   int auto_increment
        primary key,
    first_name    varchar(50)    null,
    last_name     varchar(50)    null,
    email         varchar(100)   null,
    phone_number  varchar(20)    null,
    hire_date     date           null,
    job_id        varchar(20)    null,
    salary        decimal(10, 2) null,
    manager_id    int            null,
    department_id int            null,
    active_status varchar(1)     null,
    constraint employees_ibfk_1
        foreign key (job_id) references jobs (job_id),
    constraint employees_ibfk_2
        foreign key (department_id) references departments (department_id)
);

create table emp_leave_applications
(
    app_id       int auto_increment
        primary key,
    employee_id  int           null,
    leave_type   int           null,
    form         date          null,
    to_date      date          null,
    total_date   int           null,
    leave_reson  varchar(2000) null,
    status       varchar(1)    null,
    approve_by   int           null,
    approve_date datetime      null,
    constraint emp_leave_applications_fk
        foreign key (employee_id) references employees (employee_id)
);

create index department_id
    on employees (department_id);

create index job_id
    on employees (job_id);

create index country_id
    on locations (country_id);

create table shifts
(
    shift_id   bigint auto_increment
        primary key,
    shift_name varchar(50)                           not null,
    start_time time                                  not null,
    end_time   time                                  not null,
    created_at timestamp default current_timestamp() not null
);

create table users
(
    user_id       int auto_increment
        primary key,
    username      varchar(100)     null,
    email         varchar(150)     null,
    password      varchar(255)     null,
    active_status char default 'Y' null,
    created_by    int              null,
    created_at    timestamp        null,
    updated_by    int              null,
    updated_at    timestamp        null,
    constraint email
        unique (email),
    constraint username
        unique (username)
);


