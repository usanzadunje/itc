/**
 * Composable that exposes properties and functions to manipulate AppModal component
 */
import { ref } from "vue";

export default function useModal() {
    /* Component properties */
    const isOpen = ref(false);
    const modalData = ref(null);

    /* Event handlers */
    const openModal = (state, data = null) => {
        modalData.value = data;

        isOpen.value = state;
    };

    return {
        /* Component properties */
        isOpen,
        modalData,

        /* Event handlers */
        openModal,
    };
}