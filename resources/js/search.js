document.querySelector('input[type="text"]').addEventListener('keyup', function () {
    let query = this.value;

    // Gửi AJAX request đến server
    fetch(`/search?query=${query}`)
        .then(response => response.json())
        .then(data => {
            let resultContainer = document.getElementById('ketquatim');
            resultContainer.innerHTML = '';  // Xóa kết quả cũ

            // Hiển thị kết quả tìm kiếm
            if (data.length === 0) {
                resultContainer.innerHTML = '<p>No products found</p>';
            } else {
                let listGroup = document.createElement('div');
                listGroup.classList.add('list-group');

                data.forEach(sp => {
                    let a = document.createElement('a');
                    a.href = '#';
                    a.classList.add('list-group-item', 'list-group-item-action');

                    let div = document.createElement('div');
                    div.classList.add('d-flex', 'w-100', 'justify-content-between');

                    let h5 = document.createElement('h5');
                    h5.classList.add('mb-1');
                    h5.textContent = sp.tensp;

                    let small = document.createElement('small');
                    small.classList.add('text-muted');
                    small.textContent = sp.ngay;

                    let p = document.createElement('p');
                    p.classList.add('mb-1');
                    p.textContent = sp.mota;

                    div.appendChild(h5);
                    div.appendChild(small);
                    a.appendChild(div);
                    a.appendChild(p);
                    listGroup.appendChild(a);
                });

                resultContainer.appendChild(listGroup);
            }
        })
        .catch(error => console.error('Error fetching data:', error));
});
