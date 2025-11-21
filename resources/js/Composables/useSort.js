import { ref, computed } from "vue";

export default function useSort(items, defaultKey = "id") {
    const sortKey = ref(defaultKey);
    const sortDirection = ref("asc"); // asc / desc

    function sortBy(key) {
        if (sortKey.value === key) {
            // toggle ascend-descend
            sortDirection.value = sortDirection.value === "asc" ? "desc" : "asc";
        } else {
            sortKey.value = key;
            sortDirection.value = "asc";
        }
    }

    const sortedItems = computed(() => {
        return [...items.value].sort((a, b) => {
            const valA = a[sortKey.value];
            const valB = b[sortKey.value];

            return sortDirection.value === "asc"
                ? valA > valB ? 1 : -1
                : valA < valB ? 1 : -1;
        });
    });

    return { sortKey, sortDirection, sortedItems, sortBy };
}
