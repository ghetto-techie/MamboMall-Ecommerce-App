import './bootstrap';
import 'flowbite';
import { initFlowbite } from 'flowbite';


// --- Livewire and Flowbite Integration ---
// This listener will re-initialize Flowbite's components every time Livewire finishes navigation.
// This is crucial for keeping interactive elements like dropdowns, modals, and the mobile menu working.
document.addEventListener('livewire:navigated', () => {
    console.log('Livewire navigation detected, re-initializing Flowbite.');
    initFlowbite();

    // Re-attach the dark mode toggle logic after navigation
    const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
    const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');
    
    if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        if(themeToggleLightIcon) themeToggleLightIcon.classList.remove('hidden');
    } else {
        if(themeToggleDarkIcon) themeToggleDarkIcon.classList.remove('hidden');
    }

    const themeToggleBtn = document.getElementById('theme-toggle');

    if (themeToggleBtn) {
         themeToggleBtn.addEventListener('click', function() {
            themeToggleDarkIcon.classList.toggle('hidden');
            themeToggleLightIcon.classList.toggle('hidden');
            if (localStorage.getItem('color-theme')) {
                if (localStorage.getItem('color-theme') === 'light') {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                } else {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                }
            } else {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                }
            }
        });
    }
});
