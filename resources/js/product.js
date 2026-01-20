function deleteProduct(id) {
    if (confirm('Yakin ingin menghapus produk ini?')) {
        document.getElementById('delete-product-form-' + id).submit();
    }
}

// agar bisa dipanggil dari onclick di Blade
window.deleteProduct = deleteProduct;
