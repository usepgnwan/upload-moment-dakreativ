import './bootstrap';
import GLightbox from 'glightbox';
import 'glightbox/dist/css/glightbox.min.css';
import $ from 'jquery';
// Ensure jQuery is globally available
window.$ = window.jQuery = $;
import { initTooltips } from './initTooltip';
window.GLightbox = GLightbox;
import { Tooltip, Dropdown } from 'flowbite';

import { select, on } from './custom';


import initSelect2 from './select2';

document.addEventListener('livewire:initialized', function () {
    document.addEventListener('livewire:navigated', () => {
        initSelect2()
        window.initSelect2 = function () {
            return initSelect2();
        }
        setTimeout(() => {
            initTooltips()
        }, 1000)
        window.addEventListener('popstate', () => {


            setTimeout(() => {
                tinyEditor();
            },1000)
        });

        function initializeFlowbite() {
            // Initialize Dropdowns
            const dropdowns = document.querySelectorAll('[data-dropdown-toggle]');
            dropdowns.forEach(dropdown => {
                dropdown.addEventListener('click', function () {
                    const targetId = this.getAttribute('data-dropdown-toggle');
                    const targetElement = document.getElementById(targetId);
                    if (targetElement) {
                        targetElement.classList.toggle('hidden');
                    }
                });
            });

            // Initialize Collapse
            const collapses = document.querySelectorAll('[data-collapse-toggle]');
            collapses.forEach(collapse => {
                collapse.addEventListener('click', function () {
                    const targetId = this.getAttribute('data-collapse-toggle');
                    const targetElement = document.getElementById(targetId);
                    if (targetElement) {
                        targetElement.classList.toggle('hidden');
                    }
                });
                });
        }
        initializeFlowbite()
        on('click', '.button-menu', function () {
            let $this = this;
            let content = select('.octa-body-content')
            let menu = select('#drawer-disabled-backdrop')
            let footer = select('.octa-footer')
            if ($this.classList.contains('h-opened')) {
                $this.classList.remove('h-opened')
                $this.classList.remove('bg-white')
                // $this.classList.add('bg-slate-400')

                content.classList.remove('w-4/5')
                content.classList.add('w-full')
                footer.classList.remove('sm:w-4/5')
                menu.classList.add('-translate-x-full')
                $this.querySelector('.h-open').classList.remove('hidden')
                $this.querySelector('.h-close').classList.add('hidden')
            } else {
                footer.classList.add('sm:w-4/5')
                menu.classList.remove('-translate-x-full')
                content.classList.add('w-4/5')
                content.classList.remove('w-full')
                $this.classList.add('h-opened')
                $this.classList.add('bg-white')
                // $this.classList.remove('bg-slate-400')
                $this.querySelector('.h-open').classList.add('hidden')
                $this.querySelector('.h-close').classList.remove('hidden')
            }
        })
        const mediaQuery = window.matchMedia('(max-width: 992px)'); // max-lg breakpoint

        function changeMenu(e) {

            let menu = select('#drawer-disabled-backdrop')
            const buttonMenu = document.querySelector('.button-menu');
            if (e.matches && buttonMenu) {
                buttonMenu.click();
            }
        }
        changeMenu(mediaQuery)
        mediaQuery.addEventListener('change', (e) => {
            changeMenu(e);
        });

            const html = select('html')
            on('click', '.dark-button', function (e) {
                const $this = this.classList;
                if ($this.contains('icon-[ph--sun-light]')) {
                    $this.add('icon-[line-md--moon-loop]');
                    $this.remove('icon-[ph--sun-light]');
                    html.classList.add('dark')
                    localStorage.theme = 'dark'
                } else {
                    $this.remove('icon-[line-md--moon-loop]');
                    $this.add('icon-[ph--sun-light]');
                    html.classList.remove('dark')
                    localStorage.theme = 'light'
                }
            });

            const darkbtn = select('.dark-button');
            if (localStorage.theme !== undefined) {
                if ((localStorage.theme !== '' && localStorage.theme === 'dark') || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                    if (darkbtn != null) {

                        darkbtn.classList.add('icon-[line-md--moon-loop]');
                    }
                    html.classList.add('dark')
                } else {
                    if (darkbtn != null) {
                        darkbtn.classList.add('icon-[ph--sun-light]');
                    }
                    html.classList.remove('dark')
                }
            } else {
                if (darkbtn != null) {
                    darkbtn.classList.add('icon-[ph--sun-light]');
                }
                html.classList.remove('dark')
            }

            on('click', '.menu-group-dashboard', function (e) {
                let list = this.querySelector('.icon-arrow').classList;
                console.log(list)
                if (list.contains('icon-[simple-line-icons--arrow-left]')) {
                    list.add('icon-[simple-line-icons--arrow-down]');
                    list.remove('icon-[simple-line-icons--arrow-left]');
                    list.remove('group-hover/rotate:-rotate-90');
                    list.add('group-hover/rotate:rotate-90');
                } else {
                    list.add('icon-[simple-line-icons--arrow-left]');
                    list.remove('icon-[simple-line-icons--arrow-down]');
                    list.add('group-hover/rotate:-rotate-90');
                    list.remove('group-hover/rotate:rotate-90');
                }
            });
    })

});
