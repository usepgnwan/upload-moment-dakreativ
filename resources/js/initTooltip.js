import { Tooltip, Dropdown } from 'flowbite';

const initTooltips = () =>{
    // Select all tooltip trigger elements

    const $triggerEls = document.querySelectorAll('#tooltip-default');

    // Initialize tooltips for each trigger element
    $triggerEls.forEach($triggerEl => {
        const targetId = $triggerEl.getAttribute('data-tooltip-target');
        const position = $triggerEl.getAttribute('data-position');

        const $targetEl = document.getElementById(targetId);
        // console.log($targetEl)
        if ($targetEl) {
            const options = {
                placement: position ?? 'top',
                triggerType: 'hover',
                onHide: () => {
                    console.log('tooltip is hidden');
                },
                onShow: () => {
                    console.log('tooltip is shown');
                },
                onToggle: () => {
                    console.log('tooltip is toggled');
                },
            };

            const tooltip = new Tooltip($targetEl, $triggerEl, options);

            tooltip.init();
        }
    });

}


export { initTooltips };
