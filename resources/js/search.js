document.getElementById('searchButton').addEventListener('click', function(event) {
    event.preventDefault();  // Ngăn không cho nút submit lại trang

    // Lấy giá trị từ input tìm kiếm và danh mục
    const searchTerm = document.getElementById('searchInput').value;
    const selectedCategory = document.getElementById('categorySelect').value;

    // Kiểm tra nếu không có từ khóa tìm kiếm
    if (!searchTerm) {
        alert('Please enter a search term.');
        return;
    }

    // Hiển thị từ khóa tìm kiếm
    const resultContainer = document.getElementById('ketquatim');
    resultContainer.style.display = 'block'; // Hiển thị kết quả tìm kiếm
    resultContainer.innerHTML = `<h4>Results for: "${searchTerm}"</h4>`;

    // Gửi yêu cầu tìm kiếm qua AJAX (fetch API)
    fetch(`/search?term=${searchTerm}&category=${selectedCategory}`)
        .then(response => response.json())  // Chuyển đổi phản hồi từ JSON
        .then(data => {
            // Xóa kết quả cũ nếu có
            const results = document.createElement('div');
            results.innerHTML = '';

            // Kiểm tra nếu có kết quả trả về
            if (data.length > 0) {
                data.forEach(product => {
                    // Tạo HTML cho từng kết quả sản phẩm
                    results.innerHTML += `
                        <div class="search-result border p-2 mb-2">
                            <h4>${product.name}</h4>
                            <p>${product.description || 'No description available'}</p>
                            <p>Price: $${product.price}</p>
                        </div>`;
                });
            } else {
                results.innerHTML = '<p>No results found</p>';  // Nếu không có kết quả
            }

            // Thêm kết quả vào phần tử hiển thị
            resultContainer.innerHTML += results.innerHTML;
        })
        .catch(error => {
            console.error('Error fetching search results:', error);
        });
});
