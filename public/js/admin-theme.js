/**
 * Admin Panel Dark Mode Theme Switcher
 * Handles theme switching between light and dark modes
 */

class AdminThemeManager {
    constructor() {
        this.themeToggle = document.getElementById('themeToggle');
        this.themeIcon = document.getElementById('themeIcon');
        this.themeText = document.getElementById('themeText');
        this.html = document.documentElement;
        this.currentTheme = 'light';
        
        this.init();
    }
    
    init() {
        if (!this.themeToggle) return;
        
        // Load saved theme from localStorage
        this.loadTheme();
        
        // Add event listeners
        this.themeToggle.addEventListener('click', () => this.toggleTheme());
        
        // Watch for theme changes
        this.observeThemeChanges();
        
        // Apply initial theme
        this.applyTheme();
    }
    
    loadTheme() {
        this.currentTheme = localStorage.getItem('admin-theme') || 'light';
        this.html.setAttribute('data-bs-theme', this.currentTheme);
        this.updateThemeUI();
    }
    
    toggleTheme() {
        this.currentTheme = this.currentTheme === 'light' ? 'dark' : 'light';
        this.html.setAttribute('data-bs-theme', this.currentTheme);
        localStorage.setItem('admin-theme', this.currentTheme);
        this.updateThemeUI();
        this.applyTheme();
        
        // Dispatch custom event for other components
        window.dispatchEvent(new CustomEvent('themeChanged', { 
            detail: { theme: this.currentTheme } 
        }));
    }
    
    updateThemeUI() {
        if (this.currentTheme === 'dark') {
            this.themeIcon.className = 'bi bi-moon-fill icon';
            this.themeText.textContent = 'Dark';
            this.themeToggle.title = 'Switch to light mode';
            this.themeToggle.classList.add('active');
        } else {
            this.themeIcon.className = 'bi bi-sun-fill icon';
            this.themeText.textContent = 'Light';
            this.themeToggle.title = 'Switch to dark mode';
            this.themeToggle.classList.remove('active');
        }
    }
    
    applyTheme() {
        // Add/remove dark mode class to body
        if (this.currentTheme === 'dark') {
            document.body.classList.add('dark-mode');
        } else {
            document.body.classList.remove('dark-mode');
        }
        
        // Update Bootstrap components if needed
        this.updateBootstrapComponents();
    }
    
    updateBootstrapComponents() {
        // Update any Bootstrap components that need theme-specific styling
        const tables = document.querySelectorAll('.table');
        const cards = document.querySelectorAll('.card');
        const alerts = document.querySelectorAll('.alert');
        
        // Force re-render of components
        tables.forEach(table => {
            table.style.transition = 'all 0.3s ease';
        });
        
        cards.forEach(card => {
            card.style.transition = 'all 0.3s ease';
        });
        
        alerts.forEach(alert => {
            alert.style.transition = 'all 0.3s ease';
        });
    }
    
    observeThemeChanges() {
        const observer = new MutationObserver((mutations) => {
            mutations.forEach((mutation) => {
                if (mutation.type === 'attributes' && mutation.attributeName === 'data-bs-theme') {
                    this.currentTheme = this.html.getAttribute('data-bs-theme');
                    this.applyTheme();
                }
            });
        });
        
        observer.observe(this.html, {
            attributes: true,
            attributeFilter: ['data-bs-theme']
        });
    }
    
    // Public method to get current theme
    getCurrentTheme() {
        return this.currentTheme;
    }
    
    // Public method to set theme programmatically
    setTheme(theme) {
        if (['light', 'dark'].includes(theme)) {
            this.currentTheme = theme;
            this.html.setAttribute('data-bs-theme', theme);
            localStorage.setItem('admin-theme', theme);
            this.updateThemeUI();
            this.applyTheme();
        }
    }
}

// Initialize theme manager when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    window.adminThemeManager = new AdminThemeManager();
    
    // Add smooth transitions for theme switching
    document.body.style.transition = 'background-color 0.3s ease, color 0.3s ease';
    
    // Listen for theme changes from other components
    window.addEventListener('themeChanged', function(event) {
        console.log('Theme changed to:', event.detail.theme);
    });
});

// Export for use in other scripts
if (typeof module !== 'undefined' && module.exports) {
    module.exports = AdminThemeManager;
} 