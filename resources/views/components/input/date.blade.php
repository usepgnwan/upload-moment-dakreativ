@props([
    'default_format' => 'yyyy-MM-dd',
    'timepicker' => false,
])
<div x-data="{ value: @entangle($attributes->wire('model')).defer }"
     x-init="
        new AirDatepicker($refs.input, {
        timepicker: {{ $timepicker ? 'true' : 'false' }},  // Pass the boolean correctly
        dateFormat: '{{ $default_format }}',  // Pass the format string correctly
        isMobile: true,
        autoClose: true,
        onSelect: function({date}) {
            let selectedDate = '';
            if ({{ $timepicker ? 'true' : 'false' }}) {
                // If timepicker is enabled, include both date and time
                $refs.input.value = date.toISOString().split('.')[0].replace('T', ' ');
                selectedDate = $refs.input.value;
            } else {
                // If timepicker is disabled, only include the date part
                $refs.input.value = date.toLocaleDateString('id-ID'); // YYYY-MM-DD format
                selectedDate = $refs.input.value;
            }
            $wire.set('{{ $attributes->wire('model')->value() }}', selectedDate);
        },
        locale: {
            days: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
            daysShort: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
            daysMin: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
            months: ['January','February','March','April','May','June','July','August','September','October','November','December'],
            monthsShort: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            today: 'Today',
            clear: 'Clear',
            firstDay: 0
        }
    });
" id="">
    <input x-ref="input" x-bind:value="value"   {{ $attributes->merge(['class' => 'rounded flex-1 form-input border px-3 py-2 block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light ']) }}/>
</div>
