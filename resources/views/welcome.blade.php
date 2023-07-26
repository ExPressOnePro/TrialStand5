@extends('layouts.app')
@section('title') Meeper | Таблица @endsection
@section('content')

    <div class="main-content pt-4">
        <div class="breadcrumb">
            <h1>Smart Wizard</h1>
            <ul>
                <li><a href="href">UI Kits</a></li>
                <li>Smart Wizard</li>
            </ul>
        </div>
        <div class="separator-breadcrumb border-top"></div>
        <div class="row mb-3">
            <div class="col-12 col-lg-6 col-sm-12">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="theme_selector">Themes</label>
                        <select class="custom-select col-lg-6 col-sm-12" id="theme_selector">
                            <option value="default">default</option>
                            <option value="arrows">arrows</option>
                            <option value="circles">circles</option>
                            <option value="dots">dots</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-sm-12 d-flex flex-column flex-sm-row align-items-center"><span class="m-auto"></span>
                <label>External Buttons:</label>
                <div class="btn-group col-lg-6 col-sm-12 pl-sm-3" role="group">
                    <button class="btn btn-secondary disabled" id="prev-btn" type="button">Go Previous</button>
                    <button class="btn btn-secondary" id="next-btn" type="button">Go Next</button>
                    <button class="btn btn-danger" id="reset-btn" type="button">Reset Wizard</button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <!--  SmartWizard html -->
                <div id="smartwizard" class="sw-main sw-theme-default">
                    <ul class="nav nav-tabs step-anchor">
                        <li class="nav-item active"><a href="#step-1" class="nav-link">Step 1<br><small>This is step description</small></a></li>
                        <li class="nav-item done"><a href="#step-2" class="nav-link">Step 2<br><small>This is step description</small></a></li>
                        <li class="nav-item"><a href="#step-3" class="nav-link">Step 3<br><small>This is step description</small></a></li>
                        <li class="nav-item"><a href="#step-4" class="nav-link">Step 4<br><small>This is step description</small></a></li>
                    </ul>
                    <div class="btn-toolbar sw-toolbar sw-toolbar-top justify-content-end"><div class="btn-group mr-2 sw-btn-group" role="group"><button class="btn btn-secondary sw-btn-prev disabled" type="button">Previous</button><button class="btn btn-secondary sw-btn-next" type="button">Next</button></div><div class="btn-group mr-2 sw-btn-group-extra" role="group"><button class="btn btn-info">Finish</button><button class="btn btn-danger">Cancel</button></div></div><div class="sw-container tab-content" style="min-height: 126.417px;">
                        <div id="step-1" class="tab-pane step-content" style="display: block;">
                            <h3 class="border-bottom border-gray pb-2">Step 1 Content</h3>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                        </div>
                        <div id="step-2" class="tab-pane step-content" style="display: none;">
                            <h3 class="border-bottom border-gray pb-2">Step 2 Content</h3>
                            <div>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</div>
                        </div>
                        <div id="step-3" class="tab-pane step-content">
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.

                        </div>
                        <div id="step-4" class="tab-pane step-content">
                            <h3 class="border-bottom border-gray pb-2">Step 4 Content</h3>
                            <div class="card o-hidden">
                                <div class="card-header">My Details</div>
                                <div class="card-block p-0">
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <th>Name:</th>
                                            <td>Tim Smith</td>
                                        </tr>
                                        <tr>
                                            <th>Email:</th>
                                            <td>example@example.com</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div><div class="btn-toolbar sw-toolbar sw-toolbar-bottom justify-content-end"><div class="btn-group mr-2 sw-btn-group" role="group"><button class="btn btn-secondary sw-btn-prev disabled" type="button">Previous</button><button class="btn btn-secondary sw-btn-next" type="button">Next</button></div><div class="btn-group mr-2 sw-btn-group-extra" role="group"><button class="btn btn-info">Finish</button><button class="btn btn-danger">Cancel</button></div></div>
                </div>
            </div>
        </div><!-- end of main-content -->
    </div>
