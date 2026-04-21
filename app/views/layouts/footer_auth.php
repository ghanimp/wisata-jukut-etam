    </div><!-- .auth-right -->
</div><!-- .auth-wrap -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function switchTab(tab) {
        const panelLogin = document.getElementById('panel-login');
        const panelRegister = document.getElementById('panel-register');
        const tabLogin = document.getElementById('tab-login');
        const tabRegister = document.getElementById('tab-register');
        
        if (tab === 'login') {
            panelLogin.style.display = 'block';
            panelRegister.style.display = 'none';
            tabLogin.classList.add('active');
            tabRegister.classList.remove('active');
        } else {
            panelLogin.style.display = 'none';
            panelRegister.style.display = 'block';
            tabLogin.classList.remove('active');
            tabRegister.classList.add('active');
        }
    }
    
    // Set default tab
    document.addEventListener('DOMContentLoaded', function() {
        <?php if(($activeTab ?? 'login') === 'register'): ?>
            switchTab('register');
        <?php else: ?>
            switchTab('login');
        <?php endif; ?>
    });
</script>
</body>
</html>