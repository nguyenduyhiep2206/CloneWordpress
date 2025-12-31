<?php get_header('v2'); ?>

<div class="homepage-hero bg-light py-5">
    <div class="container text-center my-5">
        <h2 class="display-4 mb-3">Chào mừng đến với LearnWP!</h2>
        <p class="lead mb-4">Khám phá các bài viết và dịch vụ hấp dẫn được chia sẻ bởi LearnWP.</p>
        <a href="<?php echo home_url('/category/blog'); ?>" class="btn btn-primary btn-lg">Khám phá ngay</a>
    </div>
</div>

<!-- Custom Application Form Display -->
<div class="container my-5">
    <h3 class="mb-4">Nộp đơn ứng tuyển</h3>
    <?php if ( isset($_POST['submit']) ): ?>
        <div class="alert alert-success">
            Cảm ơn bạn đã gửi đơn ứng tuyển!
        </div>
    <?php endif; ?>
    <form method="post" enctype="multipart/form-data" class="row g-3" style="max-width:500px;margin:auto;">
        <div class="mb-3">
            <label for="email" class="form-label">Địa chỉ Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="cv" class="form-label">Link CV</label>
            <input type="text" name="cv" id="cv" class="form-control" required>
        </div>
        <button type="submit" name="submit" class="btn btn-success">Gửi đơn</button>
    </form>
</div>
<!-- End Custom Application Form Display -->

<?php get_template_part('includes/section', 'content'); ?>

<?php get_footer('v2'); ?>