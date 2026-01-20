function deleteCategory(id) {
    if (confirm('Yakin ingin menghapus kategori ini?')) {
        document.getElementById('delete-category-form-' + id).submit();
    }
}

window.deleteCategory = deleteCategory; // agar bisa dipanggil dari inline HTML
