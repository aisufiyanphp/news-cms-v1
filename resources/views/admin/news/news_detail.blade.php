@extends('admin.layout.layout')

@section('title', 'News Detail :: News CMS V1')

@section('page-title', 'News Detail')

@section('content')

<div class="container my-4">

    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h4 class="mb-0">News Details</h4>
        </div>

        <div class="card-body">

            <!-- Title -->
            <h3 class="mb-3"><?= $news->title; ?></h3>

            <!-- Thumbnail -->
            <?php if(!empty($news->thumbnail)) { ?>
                <div class="text-center mb-4">
                    <img src="{{asset('image').'/'.$news->thumbnail}}" 
                         class="img-fluid rounded shadow" 
                         style="max-width:350px;">
                </div>
            <?php } ?>

            <!-- Two Column Layout -->
            <div class="row">

                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr>
                            <th>Category</th>
                            <td><?= $news->category_id; ?></td>
                        </tr>
                        <tr>
                            <th>Sub Category</th>
                            <td><?= $news->title; ?></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td><?= ($news->status == 1 ? 'Published' : 'Draft'); ?></td>
                        </tr>
                        <tr>
                            <th>Publish Date</th>
                            <td><?= $news->publish_date; ?></td>
                        </tr>
                        <tr>
                            <th>Publish Time</th>
                            <td><?= $news->publish_time; ?></td>
                        </tr>
                        <tr>
                            <th>Publish End Date</th>
                            <td><?= $news->publish_end_date; ?></td>
                        </tr>
                    </table>
                </div>

                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr>
                            <th>Slug</th>
                            <td><?= $news->slug; ?></td>
                        </tr>
                        <tr>
                            <th>Meta Title</th>
                            <td><?= $news->meta_title; ?></td>
                        </tr>
                        <tr>
                            <th>Meta Keywords</th>
                            <td><?= $news->meta_keywords; ?></td>
                        </tr>
                        <tr>
                            <th>Meta Description</th>
                            <td><?= $news->meta_description; ?></td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td><?= $news->created_at; ?></td>
                        </tr>
                        <tr>
                            <th>Updated At</th>
                            <td><?= $news->updated_at; ?></td>
                        </tr>
                    </table>
                </div>

            </div>

            <!-- Description -->
            <div class="mt-4">
                <h5>Description</h5>
                <div class="border p-3" style="background:#fafafa;">
                    <?= $news->description; ?>
                </div>
            </div>

            <!-- Back Button -->
            <div class="mt-4 text-right">
                <a href="" class="btn btn-secondary">
                    Back to News List
                </a>
            </div>
            

        </div>
    </div>

</div>
@endsection



