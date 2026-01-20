function toggleSpecs() {
    const specsContent = document.getElementById('product-specs');
    const icon = document.getElementById('specs-icon');
    
    specsContent.classList.toggle('hidden');
    icon.classList.toggle('rotate-180');
}

// Animasi hover untuk gambar produk
document.querySelector('.product-image-container img')?.addEventListener('mouseover', function() {
    this.classList.add('transform', 'scale-105');
});

document.querySelector('.product-image-container img')?.addEventListener('mouseout', function() {
    this.classList.remove('transform', 'scale-105');
});