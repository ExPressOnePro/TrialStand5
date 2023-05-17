@extends('layouts.app')
@section('title')Stand | изменение времени@endsection
@section('content')

    <div class="main-content pt-4">
        <div class="breadcrumb">
            <h1 class="mr-2">Стенд</h1>
            <ul>
                <li><a href="">страница</a></li>
                <li></li>
            </ul>
        </div>
        <div class="separator-breadcrumb border-top"></div>
        <div class="row">
            <!-- ICON BG-->
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center">
                        <a class=""></a>
                        <i class="fa fa-gear fa-shake text-50"></i>
                        <div class="content">
                            <p class="text-primary text-24 line-height-1 mb-2">Настройка Стенда</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center"><i class="i-Financial"></i>
                        <div class="content">
                            <p class="text-muted mt-2 mb-0">Sales</p>
                            <p class="text-primary text-24 line-height-1 mb-2">$4021</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center"><i class="i-Checkout-Basket"></i>
                        <div class="content">
                            <p class="text-muted mt-2 mb-0">Orders</p>
                            <p class="text-primary text-24 line-height-1 mb-2">80</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center"><i class="i-Money-2"></i>
                        <div class="content">
                            <p class="text-muted mt-2 mb-0">Expense</p>
                            <p class="text-primary text-24 line-height-1 mb-2">$1200</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            {{--<div class="col-md-6">
                <!-- begin::headings-->
                <div class="card mt-4 mt-4">
                    <div class="card-header bg-transparent">
                        <h3 class="card-title">Headings</h3>
                    </div>
                    <div class="card-body">
                        <div class="card-title"><span class="section-info">All HTML headings, <code>&lt;h1&gt;</code> through <code>&lt;h6&gt;</code>, are available.</span>
                            <div class="row mt-4 mb-4">
                                <div class="col-md-6">
                                    <h1 class="heading">h1. Heading 1</h1>
                                    <div class="br"></div>
                                    <h2 class="heading">h2. Heading 2</h2>
                                    <div class="br"></div>
                                    <h3 class="heading">h3. Heading 3</h3>
                                    <div class="br"></div>
                                    <h3 class="heading">h3. Heading 3</h3>
                                    <div class="br"></div>
                                    <h4 class="heading">h4. Heading 4</h4>
                                    <div class="br"></div>
                                    <h5 class="heading">h5. Heading 5</h5>
                                    <div class="br"></div>
                                    <h6 class="heading">h6. Heading 6</h6>
                                </div>
                                <div class="col-md-6">
                                    <h1 class="heading text-primary">h1. Heading 1</h1>
                                    <div class="card-title"></div>
                                    <h2 class="heading text-secondary">h2. Heading 2</h2>
                                    <div class="br"></div>
                                    <h3 class="heading text-success">h3. Heading 3</h3>
                                    <div class="br"></div>
                                    <h3 class="heading text-danger">h3. Heading 3</h3>
                                    <div class="br"></div>
                                    <h4 class="heading text-warning">h4. Heading 4</h4>
                                    <div class="br"></div>
                                    <h5 class="heading text-info">h5. Heading 5</h5>
                                    <div class="br"></div>
                                    <h6 class="heading text-info">h6. Heading 6</h6>
                                </div>
                            </div>
                            <div class="br"></div>
                            <div class="row">
                                <div class="col-md-12"><span class="section-info">Use the included utility classes to recreate the small secondary heading text.</span>
                                    <div class="br"></div>
                                    <h3 class="heading">Fancy display heading<small class="text-mute">With faded secondary text</small></h3><span class="section-info">Larger, slightly more opinionated heading styles.</span>
                                    <div class="display-content">
                                        <h3 class="heading display-1">Display 1</h3>
                                        <h3 class="heading display-2">Display 2</h3>
                                        <h3 class="heading display-3">Display 3</h3>
                                    </div>
                                    <div class="br"></div><span class="section-info">Make a paragraph stand out by adding <code>.lead</code></span>
                                    <div class="content-section">
                                        <p class="lead text-mute">Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo luctus.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end::headings-->
                <!-- begin:general-->
                <div class="card mt-4 mt-4">
                    <div class="card-header bg-transparent">
                        <h3 class="card-title">General</h3>
                    </div>
                    <div class="card-body">
                        <div class="card-title"><span class="section-info">Styling for common inline HTML5 elements:</span>
                            <div class="row mt-4 mb-4">
                                <div class="col-md-12">
                                    <p>You can use the mark tag to
                                        <mark>highlight</mark> text.
                                    </p>
                                    <div class="br"></div>
                                    <p>
                                        <del>This line of text is meant to be treated as deleted text.</del>
                                    </p>
                                    <div class="br"></div>
                                    <p>
                                        <s>This line of text is meant to be treated as no longer accurate.</s>
                                    </p>
                                    <div class="br"></div>
                                    <p><ins>This line of text is meant to be treated as an addition to the document.</ins></p>
                                    <div class="br"></div>
                                    <p>
                                        <u>This line of text will render as underlined</u>
                                    </p>
                                    <div class="br"></div>
                                    <p><small>This line of text is meant to be treated as fine print.</small></p>
                                    <div class="br"></div>
                                    <p><strong>This line rendered as bold text.</strong></p>
                                    <div class="br"></div>
                                    <p><em>This line rendered as italicized text.</em></p>
                                </div>
                            </div><span class="section-info">Stylized abbreviations implementation of HTML’s <code>&lt;abbr&gt;</code> element:</span>
                            <div class="section-content">
                                <p><abbr title="attribute">attr</abbr></p>
                                <p><abbr title="HyperText Markup Language">HTML</abbr></p>
                            </div>
                            <div class="br"></div><span class="section-info mb-4">Quoting blocks of content:</span>
                            <div class="br"></div>
                            <blockquote class="blockquote">
                                <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                                <footer class="blockquote-footer">Someone famous in
                                    <cite title="Source Title">Source Title</cite>
                                </footer>
                            </blockquote>
                            <blockquote class="blockquote">
                                <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                                <footer class="blockquote-footer">Someone famous in
                                    <cite title="Source Title">Source Title</cite>
                                </footer>
                            </blockquote>
                        </div>
                    </div>
                </div>
                <!-- end:general-->
            </div--}}
        </div>
    </div>

@endsection
