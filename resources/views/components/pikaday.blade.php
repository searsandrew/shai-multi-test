<div>
    <input
        x-data
        x-ref="input"
        x-init="new Pikaday({ field: $refs.input, format: 'MM/DD/YYYY' })"
        type="text"
        {{ $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm']) }}   
    >
</div>