<script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('hidden');
            document.getElementById('main-content').classList.toggle('full');
        }

        function toggleDropdown(id) {
            const dropdowns = document.getElementsByClassName('dropdown');
            for (let dropdown of dropdowns) {
                if (dropdown.contains(document.getElementById(id))) {
                    dropdown.classList.toggle('active');
                } else {
                    dropdown.classList.remove('active');
                }
            }
            event.preventDefault();
        }

        document.addEventListener('click', function(e) {
            const sidebar = document.getElementById('sidebar');
            const toggleBtn = document.querySelector('.toggle-btn');
            if (window.innerWidth <= 768) {
                if (!sidebar.contains(e.target) && !toggleBtn.contains(e.target)) {
                    sidebar.classList.remove('show');
                }
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
