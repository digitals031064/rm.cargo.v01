import './bootstrap';
import Alpine from 'alpinejs';
import * as Flowbite from 'flowbite';
import { DataTable } from "simple-datatables";
window.Alpine = Alpine;
window.Flowbite = Flowbite;
Alpine.start();

document.addEventListener("DOMContentLoaded", () => {
    const table = document.getElementById("default-table");
    if (table) {
        const dataTable = new DataTable("#default-table", {
            searchable: false,
            perPageSelect: false
        });
    }
});