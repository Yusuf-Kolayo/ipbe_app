@extends('layouts.main')

@section('content')
<div class="container-fluid card">
    <div class="row mb-2">
        <div class="col-12 alert alert-secondary">
            <h3><i class="fas fa-th-list mr-2"></i>Payroll Lists</h3>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-md-4">
            <div class="card card-bordered h-100">
                <div class="card-inner">
                    <div class="project">
                        <div class="project-head">
                            <a href="/demo1/apps-kanban.html" class="project-title">
                                <div class="user-avatar sq bg-primary">
                                    <span>JAN</span>
                                </div>
                                <div class="project-info">
                                    <span class="sub-text">DAP</span>
                                    <h6 class="title">January Payroll</h6>
                                </div>
                            </a>
                            <div class="drodown">
                                <a href="#" class="dropdown-toggle btn btn-sm btn-icon btn-trigger mt-n1 mr-n1" data-toggle="dropdown">
                                    <em class="icon ni ni-more-h"></em>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <ul class="link-list-opt no-bdr">
                                        <li>
                                            <a href="{{route('payroll_list_monthly')}}">
                                                <em class="icon ni ni-eye"></em>
                                                <span>January Payroll</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <em class="icon ni ni-edit"></em>
                                                <span>Edit Project</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <em class="icon ni ni-check-round-cut"></em>
                                                <span>Mark As Done</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="project-progress">
                            <div class="project-progress-details">
                                <div class="project-progress-task">
                                    <em class="icon ni ni-check-round-cut"></em>
                                    <span>Employee Paid</span>
                                </div>
                                <div class="project-progress-percent font-weight-bold">25</div>
                            </div>
                            <div class="project-progress-details">
                                <div class="project-progress-task">
                                    <em class="icon ni ni-check-round-cut"></em>
                                    <span>Employee Net Pay</span>
                                </div>
                                <div class="project-progress-percent font-weight-bold">N 555,000</div>
                            </div>
                            <hr class="rounded bg-dark" style="height:4px">
                        </div>
                        <div class="project-meta">
                            <ul class="project-users g-1">
                                <li>
                                    <div class="spinner-grow text-dark" role="status"></div>
                                </li>
                                <li>
                                    <div class="user-avatar sm bg-light">
                                        <span>J</span>
                                    </div>
                                </li>
                            </ul>
                            <span class="badge badge-dim badge-light text-gray py-1 px-1">
                                <span><i class="fas fa-clock mr-1"></i>Jan 2021</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-bordered h-100">
                <div class="card-inner">
                    <div class="project">
                        <div class="project-head">
                            <a href="/demo1/apps-kanban.html" class="project-title">
                                <div class="user-avatar sq bg-warning">
                                    <span>JAN</span>
                                </div>
                                <div class="project-info">
                                    <span class="sub-text">DAP</span>
                                    <h6 class="title">January Payroll</h6>
                                </div>
                            </a>
                            <div class="drodown">
                                <a href="#" class="dropdown-toggle btn btn-sm btn-icon btn-trigger mt-n1 mr-n1" data-toggle="dropdown">
                                    <em class="icon ni ni-more-h"></em>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <ul class="link-list-opt no-bdr">
                                        <li>
                                            <a href="/demo1/apps-kanban.html">
                                                <em class="icon ni ni-eye"></em>
                                                <span>View Project</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <em class="icon ni ni-edit"></em>
                                                <span>Edit Project</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <em class="icon ni ni-check-round-cut"></em>
                                                <span>Mark As Done</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="project-progress">
                            <div class="project-progress-details">
                                <div class="project-progress-task">
                                    <em class="icon ni ni-check-round-cut"></em>
                                    <span>Employee Paid</span>
                                </div>
                                <div class="project-progress-percent font-weight-bold">25</div>
                            </div>
                            <div class="project-progress-details">
                                <div class="project-progress-task">
                                    <em class="icon ni ni-check-round-cut"></em>
                                    <span>Employee Net Pay</span>
                                </div>
                                <div class="project-progress-percent font-weight-bold">N 555,000</div>
                            </div>
                            <hr class="rounded bg-dark" style="height:4px">
                        </div>
                        <div class="project-meta">
                            <ul class="project-users g-1">
                                <li>
                                    <div class="user-avatar sm bg-dark">
                                        <i class="far fa-user-circle"></i>
                                    </div>
                                </li>
                                <li>
                                    <div class="user-avatar sm bg-light">
                                        <span>F</span>
                                    </div>
                                </li>
                            </ul>
                            <span class="badge badge-dim badge-light text-gray py-1 px-1">
                                <span><i class="fas fa-clock mr-1"></i>Jan 2021</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-bordered h-100">
                <div class="card-inner">
                    <div class="project">
                        <div class="project-head">
                            <a href="/demo1/apps-kanban.html" class="project-title">
                                <div class="user-avatar sq bg-warning">
                                    <span>JAN</span>
                                </div>
                                <div class="project-info">
                                    <span class="sub-text">DAP</span>
                                    <h6 class="title">January Payroll</h6>
                                </div>
                            </a>
                            <div class="drodown">
                                <a href="#" class="dropdown-toggle btn btn-sm btn-icon btn-trigger mt-n1 mr-n1" data-toggle="dropdown">
                                    <em class="icon ni ni-more-h"></em>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <ul class="link-list-opt no-bdr">
                                        <li>
                                            <a href="/demo1/apps-kanban.html">
                                                <em class="icon ni ni-eye"></em>
                                                <span>January payroll</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <em class="icon ni ni-edit"></em>
                                                <span>Edit Project</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <em class="icon ni ni-check-round-cut"></em>
                                                <span>Mark As Done</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="project-progress">
                            <div class="project-progress-details">
                                <div class="project-progress-task">
                                    <em class="icon ni ni-check-round-cut"></em>
                                    <span>Employee Paid</span>
                                </div>
                                <div class="project-progress-percent font-weight-bold">25</div>
                            </div>
                            <div class="project-progress-details">
                                <div class="project-progress-task">
                                    <em class="icon ni ni-check-round-cut"></em>
                                    <span>Employee Net Pay</span>
                                </div>
                                <div class="project-progress-percent font-weight-bold">N 555,000</div>
                            </div>
                            <hr class="rounded bg-dark" style="height:4px">
                        </div>
                        <div class="project-meta">
                            <ul class="project-users g-1">
                                <li>
                                    <div class="user-avatar sm bg-dark">
                                        <i class="far fa-user-circle"></i>
                                    </div>
                                </li>
                                <li>
                                    <div class="user-avatar sm bg-light">
                                        <span>M</span>
                                    </div>
                                </li>
                            </ul>
                            <span class="badge badge-dim badge-light text-gray py-1 px-1">
                                <span><i class="fas fa-clock mr-1"></i>Jan 2021</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection