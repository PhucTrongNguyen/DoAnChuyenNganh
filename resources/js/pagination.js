document.querySelectorAll('.pagination-dots li').forEach(dot => {
    dot.addEventListener('click', function() {
        const page = parseInt(this.getAttribute('data-page'));
        const parentTab = this.closest('.tab-pane');

        // Ẩn tất cả các dòng sản phẩm
        parentTab.querySelectorAll('.row').forEach((row, index) => {
            if (index === page) {
                row.style.display = 'flex'; // Hiển thị dòng sản phẩm của trang hiện tại
            } else {
                row.style.display = 'none'; // Ẩn các dòng khác
            }
        });

        // Cập nhật chấm phân trang
        parentTab.querySelectorAll('.pagination-dots li').forEach(dot => {
            dot.classList.remove('active');
        });
        this.classList.add('active');
    });
});
