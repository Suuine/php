</div> 
    
    <footer class="mt-5 py-4 bg-light">
        <div class="container text-center">
            <p class="text-muted mb-0">
                <i class="bi bi-book-fill"></i> Система управління бібліотекою &copy; <?= date('Y') ?>
            </p>
            <small class="text-muted">
                Створено з використанням PHP, MySQL та Bootstrap 5
            </small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert:not(.alert-danger)');
            alerts.forEach(function(alert) {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    </script>
</body>
</html>