# Adding new tabler icons

The default icon set for this project is [TablerIcons](https://tablericons.com). 

They should all be stored inside `./resources/js/components/core/icons/Icon{IconName}.vue` 
as this will allow them to be automatically imported and usable within the application via `<icon-icon-name />`.

## Step by step

1. Find the icon you want to use on [TablerIcons](https://tablericons.com)
2. Click it to copy the SVG
   1. Make note of the name e.g. `arrows-shuffle` 
3. Copy an existing icon, using pascal case prefixed with `Icon` e.g. `IconArrowsShuffle.vue`
   1. Alternatively use the icon template below
4. Inside the existing `<svg>` tag, paste the copied SVG
5. Remove the opening and closing `<svg ...>` that were pasted, so only the outer tag remains
6. Update the name to the pascal case icon name e.g. `IconArrowsShuffle`
7. Use the icon wherever needed via kebab case e.g. `<icon-arrows-shuffle />`

The resulting vue file should look similar to the following:
```vue
<template>
    <!-- Part of the tabler icon set: https://github.com/tabler/tabler-icons -->
    <svg
        xmlns="http://www.w3.org/2000/svg"
        width="24"
        height="24"
        viewBox="0 0 24 24"
        stroke-width="2"
        stroke="currentColor"
        fill="none"
        stroke-linecap="round"
        stroke-linejoin="round"
    >
        <path d="M18 4l3 3l-3 3" />
        <path d="M18 20l3 -3l-3 -3" />
        <path d="M3 7h3a5 5 0 0 1 5 5a5 5 0 0 0 5 5h5" />
        <path d="M21 7h-5a4.978 4.978 0 0 0 -3 1m-4 8a4.984 4.984 0 0 1 -3 1h-3" />
    </svg>
</template>

<script>
    export default {
        name: "IconArrowsShuffle",
    }
</script>
```

## Icon Template
```vue
<template>
    <!-- Part of the tabler icon set: https://github.com/tabler/tabler-icons -->
    <svg
        xmlns="http://www.w3.org/2000/svg"
        width="24"
        height="24"
        viewBox="0 0 24 24"
        stroke-width="2"
        stroke="currentColor"
        fill="none"
        stroke-linecap="round"
        stroke-linejoin="round"
    >
        
    </svg>
</template>

<script>
    export default {
        name: "IconArrowsShuffle",
    }
</script>
```
