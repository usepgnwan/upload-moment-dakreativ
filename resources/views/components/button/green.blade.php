{{--
-- Important note:
--
-- This template is based on an example from Tailwind UI, and is used here with permission from Tailwind Labs
-- for educational purposes only. Please do not use this template in your own projects without purchasing a
-- Tailwind UI license, or they’ll have to tighten up the licensing and you’ll ruin the fun for everyone.
--
-- Purchase here: https://tailwindui.com/
--}}

<x-button {{ $attributes->merge(['class' => 'text-white bg-green-400 hover:bg-green-500 active:bg-green-700 border-green-400 dark:border-green-900 dark:bg-green-900  dark:hover:bg-green-800 dark:hover:text-slate-400 ']) }}>{{ $slot }}</x-button>
