<?php
// Trang này hiển thị nội dung của một trang (page) WordPress.
// Nó sử dụng header mặc định, phần nội dung chính từ template part, và footer mặc định.

get_header('v2');

get_template_part('includes/section', 'content');

get_footer('v2');
