@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-[#D9D9D9] focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) }}>
