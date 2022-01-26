/**
 * Composable that exposes properties and functions to manipulate AppModal component
 */
import { ref } from "vue";

export default function useModal() {
    /* Component properties */
    const isOpen = ref(false);

    /* Event handlers */
    const openModal = (state = true) => {
        isOpen.value = state;
    };

    return {
        /* Component properties */
        isOpen,

        /* Event handlers */
        openModal,
    };
}