{{--
-- Important note:
--
-- This template is based on an example from Tailwind UI, and is used here with permission from Tailwind Labs
-- for educational purposes only. Please do not use this template in your own projects without purchasing a
-- Tailwind UI license, or they’ll have to tighten up the licensing and you’ll ruin the fun for everyone.
--
-- Purchase here: https://tailwindui.com/
--}}

<x-button {{ $attributes->merge(['class' => 'text-white bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 border-indigo-600 dark:border-indigo-900 dark:bg-indigo-900  dark:hover:bg-indigo-800 dark:hover:text-slate-400 ']) }}>{{ $slot }}</x-button>
