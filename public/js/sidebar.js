document.addEventListener('DOMContentLoaded', function() {
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('sidebar');
    const body = document.body;

    // Toggle sidebar
    sidebarToggle.addEventListener('click', function() {
        sidebar.classList.toggle('collapsed');
        this.classList.toggle('active');
        body.classList.toggle('sidebar-closed');
    });

    // Handle dropdown arrows
    const dropdowns = document.querySelectorAll('.dropdown-toggle');
    dropdowns.forEach(dropdown => {
        dropdown.addEventListener('click', function() {
            const arrow = this.querySelector('.fa-chevron-down');
            arrow.style.transform = this.getAttribute('aria-expanded') === 'true' 
                ? 'rotate(0deg)' 
                : 'rotate(180deg)';
        });
    });

    // Responsive behavior
    function handleResize() {
        if (window.innerWidth <= 768) {
            sidebar.classList.add('collapsed');
            body.classList.add('sidebar-closed');
        } else {
            sidebar.classList.remove('collapsed');
            body.classList.remove('sidebar-closed');
        }
    }

    window.addEventListener('resize', handleResize);
    handleResize(); // Initial check
});