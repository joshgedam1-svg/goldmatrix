document.addEventListener('DOMContentLoaded', function() {
  // Mobile sidebar toggle
  const toggleBtn = document.querySelector('.sidebar-toggle-btn');
  const sidebar = document.querySelector('.sidebar');
  
  if (toggleBtn && sidebar) {
    toggleBtn.addEventListener('click', function() {
      sidebar.classList.toggle('show');
    });
  }

  // Delete confirmation modals
  const deleteForms = document.querySelectorAll('.form-delete-confirm');
  deleteForms.forEach(form => {
    form.addEventListener('submit', function(e) {
      if (!confirm('Are you sure you want to delete this record? This action cannot be undone.')) {
        e.preventDefault();
      }
    });
  });

  // Auto-generate slug from title fields
  const titleInput = document.querySelector('input[name="title"], input[name="name"]');
  const slugInput = document.querySelector('input[name="slug"]');

  if (titleInput && slugInput && !slugInput.dataset.manual) {
    titleInput.addEventListener('keyup', function() {
      if (!slugInput.dataset.manual) {
        slugInput.value = titleInput.value
          .toLowerCase()
          .replace(/[^\w ]+/g, '')
          .replace(/ +/g, '-');
      }
    });
    slugInput.addEventListener('change', function() {
      if (slugInput.value.trim() !== '') {
        slugInput.dataset.manual = 'true';
      }
    });
  }
});
