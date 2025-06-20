<script>
    const menuToggle = document.getElementById('menuToggle');
    const sidebar = document.getElementById('sidebar');
    const studentDropdown = document.getElementById('studentDropdown');

    menuToggle.addEventListener('click', () => {
        sidebar.classList.toggle('closed');
    });

    studentDropdown.addEventListener('click', (e) => {
        e.stopPropagation();
        studentDropdown.classList.toggle('open');
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', (e) => {
        if (!studentDropdown.contains(e.target)) {
            studentDropdown.classList.remove('open');
        }
    });

    
</script>
